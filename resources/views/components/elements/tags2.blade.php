<div class="tags-list">

  @foreach ($tags as $tag)
    <span class="tag2-item">
      <a class="text-muted" href=""><i class="fa fa-tag" ></i>{{ $tag->name }}</a>
    </span>
  @endforeach
</div>
