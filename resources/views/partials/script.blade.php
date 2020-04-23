<script src="{{ asset('js/jquery.js') }}" charset="utf-8"></script>
<script src="{{ asset('plugin/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugin/jquery-tabs/dist/jquery.tabs.min.js') }}" charset="utf-8"></script>
@auth
  @if (Auth::user()->role == 'admin')
    <script src="{{ asset('js/admin.js') }}" charset="utf-8"></script>
  @elseif (Auth::user()->role == 'user')
    <script src="{{ asset('js/customer.js') }}" charset="utf-8"></script>
  @endif
@else
  <script src="{{ asset('js/customer.js') }}" charset="utf-8"></script>
@endauth
