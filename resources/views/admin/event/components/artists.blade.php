@if (App\Artist::get()->count() > 0)
@push('adminstyles')
  <style media="screen" type="text/css" >
    .artist-item{
      position: relative;
      display: flex;
      height: 10rem;
      background-color: #7777;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .artist-item i{
        opacity:0;
        color: #fff;
        transition: all 0.3s ease-in-out .1s;
        position: absolute;
        top: 8px;
        right: 8px;
        border-radius: 50%;
        background-color: rgba(0,0,0,.8);
        padding:2px;

    }

    .artist-item span{
      position: absolute;
      text-shadow: 1px 1px #aaa;
      font-family: serif;
      font-size: 1.2em;
      bottom: 0;
      color: #fff;
      width: 100%;
      text-align: center;
      z-index: 2;
      background-color: rgba( 10,15,10, .3) ;

    }
    .selected i{
        opacity:1;

        transition: all 0.3s ease-in-out .1s;
      }

      .selected::after{
        content:'';
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        background-color: rgba( 100,100,100,.3)
      }
  </style>

@endpush
<h4>Artists</h4>
<div id="event-artists" class="artist-media p-2 shadow bg-transparent mb-3">
    @foreach (App\Artist::get()->chunk(4) as $artist_group)
      <div class="row mb-2">
          @foreach ($artist_group as $artist)
            @if ( !empty($model) )
                @if ( in_array( $artist->id, $model->artists()->pluck('artists.id')->toArray() ) )
                  <div class="col-sm-3">
                    <div class="artist-item selected" data-artist="{{ $artist->id }}" style="background-image:url('{{ asset('storage/artists/'.$artist->artist_image ) }}')">
                      <span>{{ $artist->name }}</span>
                      <i class="fa fa-2x fa-check"></i>
                    </div>
                  </div>
                  <input id="event_artist-{{ $artist->id }}" name="artist[]" value="{{ $artist->id }}"  hidden='hidden' />
                @else
                  <div class="col-sm-3">
                    <div class="artist-item" data-artist="{{ $artist->id }}" style="background-image:url('{{ asset('storage/artists/'.$artist->artist_image ) }}')">
                      <span>{{ $artist->name }}</span>
                      <i class="fa fa-check"></i>
                    </div>
                  </div>
                @endif
              @else
                <div class="col-sm-3">
                  <div class="artist-item" data-artist="{{ $artist->id }}" style="background-image:url('{{ asset('storage/artists/'.$artist->artist_image ) }}')">
                    <span>{{ $artist->name }}</span>
                    <i class="fa fa-check"></i>
                  </div>
                </div>
              @endif
          @endforeach
      </div>
    @endforeach
</div>
@else
  <h4 class="text-center">No Artists in the Database</h4>
@endif
