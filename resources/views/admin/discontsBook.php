@if($book->author->status_discont_id == 1 &&  $book->discont_privat != null)
  @if($book->discont_global >= $book->author->discont_id)
  <td>{{$book->discont_global}}</td>
  <td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
  @else
  <td>{{$book->author->discont_id}}</td>
  <td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
  @endif
@elseif($book->discont_privat != null)
<td>{{$book->discont_global}}</td>
<td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
@elseif($book->author->status_discont_id == 1)
<td>{{$book->author->discont_id}}</td>
<td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
@else
<td>0</td>
<td>{{$book->price}}</td>
@endif