<!DOCTYPE html>
<html>
  
<head>
    <title>Mes Videos</title>
    <style type="text/css">
        table {
            color: #333;
            font-family: sans-serif;
            width: 640px;
            border-collapse: collapse;
            border-spacing: 0;
        }
          
        td,
        th {
            border: 1px solid #CCC;
            height: 30px;
        }
          
        th {
            background: #F3F3F3;
            font-weight: bold;
        }
          
        td {
            background: #FAFAFA;
            text-align: center;
        }
    </style>
</head>
  
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Image</td>
            <td>Action</td>
        </tr>
        @foreach ($videos as $video)
        <tr>
            <td>{{ $video->id }}</td>
            <td>{{ $video->name }}</td>
            <td>{{ $video->image }}</td>
            <td>
                <a href="{{ route('videos.index') }}" onclick="event.preventDefault();document.getElementById('delete-form-{{$photo->id}}').submit();">
                 Supprimer 
                </a>
            </td>
            <form id="delete-form-{{$video->id}}" + action="{{route('videos.destroy', $video->id)}}" method="post">
                @csrf @method('DELETE')
            </form>
        </tr>
        @endforeach
    </table>
</body>
  
</html>