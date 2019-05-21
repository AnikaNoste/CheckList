<table >
  <thead>
    <tr>
      <td style="width:4%;">id</td>
      <td style="width:10%;">userId</td>
      <td style="width:50%;">titleList</td>
	  <td>created_at</td>
	  <td>updated_at</td>
    </tr>
  </thead>
  <tbody>
	@for($i=0;$i<count($id);$i++)
		@if($status[$i]==1)
		<tr style="background:#BCEE68;">
		@else
		<tr style=" background:#FFDAB9;">
		@endif
		<td>{{ $id[$i] }}</td>
		<td>{{ $userId[$i] }}</td>
		<td>{{ $titleList[$i] }}</td>
		<td>{{ $created_at[$i] }}</td>
		<td>{{ $updated_at[$i] }}</td>
		</tr>
	@endfor
  </tbody>
</table>
<td>{{ $_SESSION['error'] }}</td>
{{ $_SESSION['error'] = ''}}
<td>{{ $_SESSION['message'] }}</td>
{{ $_SESSION['message'] = ''}}


