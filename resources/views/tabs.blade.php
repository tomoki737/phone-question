<ul class="nav nav-tabs mt-3 justify-content-center">
<li class="nav-item">
    <a class="nav-link {{$hasSolve? 'active' : ''}}" href="{{route('home')}}">最近の解決済</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{$hasUnSolve? 'active' : ''}}" href="{{route('un_solve')}}">未解決</a>
  </li>
</ul>
