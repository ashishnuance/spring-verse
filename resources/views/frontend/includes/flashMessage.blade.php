{{--

@if (session()->get('success'))



  <div class="alert alert-success">

    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 

    {!! session()->get('success') !!}

  </div>



@elseif (session()->get('error'))



  <div class="alert alert-danger">

    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 

    {!! session()->get('error') !!}

  </div>



@endif

--}}