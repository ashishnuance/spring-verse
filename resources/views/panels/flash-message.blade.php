@if(session()->get('flash_warning'))

    <div class="alert-container header-alert-msg">

        <div class="alert alert-warning">
            
            <div class="alert-description">

                @if(is_array(json_decode(session()->get('flash_warning'), true)))

                    {!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}

                @else

                    {!! session()->get('flash_warning') !!}

                @endif

            </div>

        </div>

    </div>
@elseif(session()->get('flash_danger'))

    <div class="alert-container header-alert-msg">

        <div class="alert alert-danger">

           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="alert-description">

                @if(is_array(json_decode(session()->get('flash_danger'), true)))

                    {!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}

                @else

                    {!! session()->get('flash_danger') !!}

                @endif

            </div>

        </div>

    </div>

@elseif (session()->get('flash_success'))

<div class="alert-container header-alert-msg common-success-message">

    <div class="alert alert-success">
        
        
        <div class="alert-description">

            @if(is_array(json_decode(session()->get('flash_success'), true)))

                {!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}

            @else

                {!! session()->get('flash_success') !!}

            @endif

        </div>

    </div>

</div>

@elseif (session()->get('success'))

<div class="alert-container header-alert-msg common-success-message">

    <div class="alert alert-success">
        
        <div class="alert-description">

            @if(is_array(json_decode(session()->get('success'), true)))

                {!! implode('', session()->get('success')->all(':message<br/>')) !!}

            @else

                {!! session()->get('success') !!}

            @endif

        </div>

    </div>

</div>
@elseif(session()->get('danger'))

    <div class="alert-container header-alert-msg">

        <div class="alert alert-danger">

           
            <div class="alert-description">

                @if(is_array(json_decode(session()->get('danger'), true)))

                    {!! implode('', session()->get('danger')->all(':message<br/>')) !!}

                @else

                    {!! session()->get('danger') !!}

                @endif

            </div>

        </div>

    </div>
@elseif(session()->get('error'))

    <div class="alert-container header-alert-msg">

        <div class="alert alert-danger">

            
            <div class="alert-description">

                @if(is_array(json_decode(session()->get('error'), true)))

                    {!! implode('', session()->get('error')->all(':message<br/>')) !!}

                @else

                    {!! session()->get('error') !!}

                @endif

            </div>

        </div>

    </div>    

@endif
