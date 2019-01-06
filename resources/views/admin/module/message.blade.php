<div class="box-top">
  @if (session()->has('success'))
    <div class="al-success">
        <strong>{{ session('success') }}</strong>  
    </div>
  @endif
  @if (session()->has('error'))
    <div class="al-error">
        <strong>{{ session('error') }}</strong>  
    </div>
  @endif
</div>
