



document.getElementById("form").onsubmit = (e)=>{

 let name =document.getElementById("productName").value
 let price =document.getElementById("productPrice").value
 let quantite =document.getElementById("productQuantity").value

 if ( name == "" || name.length<= 3 || price=="" ||quantite ==""  ){

  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Something went wrong!',
  footer: '<a href="">Why do I have this issue?</a>'
})
  e.preventDefault();

 }
}
document.getElementById("addNew").addEventListener("click",()=>{

 let form = document.getElementById("form");
  let newDiv =  document.getElementById("addInputs").cloneNode(true)
  form.insertBefore(newDiv,form.lastElementChild)

})

