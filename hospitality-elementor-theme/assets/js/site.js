(function(){
  function closeAll(){
    document.querySelectorAll('.hu-nav-wrap.is-open').forEach(function(w){
      w.classList.remove('is-open');
      var b=w.querySelector('.hu-menu-toggle');
      if(b)b.setAttribute('aria-expanded','false');
    });
  }
  document.addEventListener('click',function(e){
    var btn=e.target.closest('.hu-menu-toggle');
    if(btn){
      var wrap=btn.closest('.hu-nav-wrap');
      var open=wrap.classList.toggle('is-open');
      btn.setAttribute('aria-expanded',open?'true':'false');
      return;
    }
    if(!e.target.closest('.hu-nav-wrap')) closeAll();
  });
  window.addEventListener('resize',function(){if(window.innerWidth>900)closeAll();});
})();