const ratio = .5
const options = {
  root:null,
  rootMargin: '0px',
  threshold: ratio,
}
const callback = function (entries, observer) {
  entries.forEach(function (entry) {
    // console.log(entry.intersectionRatio);
    if (entry.intersectionRatio > ratio){
      entry.target.classList.add('anime-visible')
    }
    else{
      // console.log('invisible')
      entry.target.classList.remove('anime-visible')
    }
  })
}
const observer = new IntersectionObserver(callback,options)
document.querySelectorAll('.anime').forEach(function(r){
  observer.observe(r)
})