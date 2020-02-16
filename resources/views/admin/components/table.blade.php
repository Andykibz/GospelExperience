<table class="table">
  <thead class="thead-dark">
    <tr>
      @if ( $column['id'] )
        <th scope="col">#</th>
      @endif
      @if ( $column['image'] )
        <th scope="col">{{ $column['image'] }}</th>
      @endif
      @if ( $column['title'] )
        <th scope="col">{{ $column['title'] }}</th>
      @endif
      @if ( $column['body'] )
        <th scope="col">{{ $column['body'] }}</th>
      @endif
      @if ( $column['date'] )
        <th scope="col">{{ $column['date'] }}</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($models as $model)
      <tr>
        @if ( $column['id'] )
          <th scope="row">1</th>
        @endif
        @if ( $column['image'] )
          <td scope="row">1</td>
        @endif
        @if ( $column['title'] )
          <td scope="row">1</td>
        @endif
        @if ( $column['body'] )
          <td scope="row">1</td>
        @endif
        @if ( $column['date'] )
          <td scope="row">1</td>
        @endif
      </tr>

    @endforeach
  </tbody>
</table>
@foreach ($columns as $column)

@endforeach
