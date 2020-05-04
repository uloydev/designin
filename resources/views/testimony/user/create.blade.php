<form action="{{route('user.testimony.store', $service)}}" method="post">
@csrf
<textarea name="content" id="" cols="30" rows="10"></textarea>
<input type="number" name="rating">
<button type="submit">submit</button>
</form>