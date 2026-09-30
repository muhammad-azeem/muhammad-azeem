(function(){
  const header=document.getElementById('site-header');
  const toggle=document.querySelector('.menu-toggle');
  const nav=document.getElementById('primary-nav');
  if(toggle&&nav){toggle.addEventListener('click',()=>{const open=toggle.getAttribute('aria-expanded')==='true';toggle.setAttribute('aria-expanded',String(!open));nav.classList.toggle('open');document.body.classList.toggle('nav-open');});}
  window.addEventListener('scroll',()=>{if(header)header.classList.toggle('scrolled',window.scrollY>18);});
  const io='IntersectionObserver' in window?new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);}});},{threshold:.12}):null;
  document.querySelectorAll('.reveal').forEach(el=>{if(io)io.observe(el);else el.classList.add('visible');});
})();