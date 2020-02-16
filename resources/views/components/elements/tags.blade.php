<div class="tags-list">
  <i class="fa fa-tag" ></i>
  @foreach ($tags as $tag)
    <span class="tag-item">
      <a class="" href="">{{ $tag->name }}</a>
    </span>
  @endforeach
</div>
