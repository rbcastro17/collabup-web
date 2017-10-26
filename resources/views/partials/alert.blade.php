@if(Session::has('info'))
<div class="ui info message">
  <div class="header">
    Was this what you wanted?
  </div>
  <ul class="list">
    <li>{{Session::get('info')}}</li>
  </ul>
</div>
@endif