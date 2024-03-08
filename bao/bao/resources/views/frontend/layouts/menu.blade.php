<div class="col-md-3 ">
    <ul class="list-group" id = "menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li> 

        
        @foreach($theloai as $tl)
        
        @if(count($tl->loaitin)>0)
        <li href="#" class="list-group-item menu1 list-group-item-danger">
            {{$tl->Ten}}
        </li>

        @foreach($tl->loaitin as $lt)
        <li class ="list-group-item">
            <a href="{{route('loaitin',[$lt->id,$lt->TenKhongDau])}}">{{$lt->Ten}}</a>
        
        </li>
        @endforeach

        @endif
    @endforeach
    </ul>
</div>

