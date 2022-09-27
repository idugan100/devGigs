<h1>{{$header}}</h1>

@foreach($listings as $listing)

    <h2><?php echo $listing["title"]?></h2>
    <p><?php echo $listing["description"];?></p>
@endforeach
