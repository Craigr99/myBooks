const faders = document.querySelectorAll('.fade-in');

const appearOptions = {
  threshold: 1,
  rootMargin: "0px 0px -200px 0px"
};

const appearOnScroll = new IntersectionObserver
(function(
  entries,
  appearOnScroll
) {
  entries.forEach(entry => {
    if (!entry.isIntersecting){
      return;
    } else {
      entry.target.classList.add('appear');
      appearOnScroll.unobserve(entry.target);
    }
  })
},
appearOptions);

faders.forEach(fader => {
  appearOnScroll.observe(fader);
});

let likebtn = document.querySelector('#likebtn');
let dislikebtn = document.querySelector('#dislikebtn');
let like = document.querySelector('#like');
let dislike = document.querySelector('#dislike');

likebtn.addEventListener('click',()=>{
  like.value = parseInt(like.value) + 1;
  like.style.color = "#12ff00";
})

dislikebtn.addEventListener('click',()=>{
  dislike.value = parseInt(dislike.value) + 1;
  dislike.style.color = "#ff0000";
})
