const allDropdown = document.querySelectorAll(' .dropdown-lateral');

allDropdown.forEach(item=> {
      
      const a = item.parentElement.querySelector('a:first-child');
      //console.log(a);
      a.addEventListener('click', function (e){
          e.preventDefault();
          if(!this.classList.contains('activar')){
            allDropdown.forEach(i=> {
              const a2 = i.parentElement.querySelector('a:first-child');
              a2.classList.remove('activar');
              i.classList.remove('visualizar');
            })

          }
          this.classList.toggle('activar');
          item.classList.toggle('visualizar');
      })
});