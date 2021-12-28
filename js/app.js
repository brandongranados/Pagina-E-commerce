   //**** Variables

   // Variables de Barra de navegación
   const navToggle = document.querySelector(".nav-toggle");
   const navMenu = document.querySelector(".nav-colapsada-vertical");
   const navUl = document.querySelector(".nav-ul");
   // Variables de carrito
   const carrito = document.querySelector('#carrito');
   const listaProductos = document.querySelector('#lista-productos');
   const contenedorCarrito = document.querySelector('#lista-carrito tbody');
   const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
   const cantidadCarrito = document.querySelector('#cantidad-carrito');
   let articulosCarrito = [];


   //**** Barra de navegación lateral
   navToggle.addEventListener("click", () => {
       navMenu.classList.toggle("nav-menu-visible");
       //navUl.classList.toggle("nav-borde");

       if (navMenu.classList.contains("nav-menu-visible")) {
           navToggle.setAttribute("aria-label", "Cerrar menú");
       } else {
           navToggle.setAttribute("aria-label", "Abrir menú");
       }
   })
   //---fin de barra de navegación lateral---


   //**** Carrito en Index.html
   // Listeners
   cargarEventListeners()

   function cargarEventListeners() {
       // Dispara cuando se presiona "Agregar Carrito"
       listaProductos.addEventListener('click', agregarCurso);
       // Cuando se elimina un producto del carrito
       carrito.addEventListener('click', eliminarCurso);
       // Al Vaciar el carrito
       vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
   }

   // Funciones
   // Función que añade el producto al carrito
   function agregarCurso(e) {
       e.preventDefault();
       // Delegation para agregar-carrito
       if (e.target.classList.contains('agregar-carrito')) {
           const producto = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
           // Enviamos el curso seleccionado para tomar sus datos
           leerDatosProducto(producto);

           window.createNotification({
               // close on click
               closeOnClick: true,
               // displays close button
               displayCloseButton: false,
               // nfc-top-left
               // nfc-bottom-right
               // nfc-bottom-left
               positionClass: 'nfc-top-right',
               // callback
               onclick: false,
               // timeout in milliseconds
               showDuration: 3500,
               // success, info, warning, error, and none
               theme: 'success'
           })({
               title: 'Producto agregado',
               message: 'Al carrito exitosamente!'
           });
       }
   }

   // Lee los datos del curso
   function leerDatosProducto(producto) {
       const infoProducto = {
           imagen: producto.querySelector('.product__item__pic img').src,
           titulo: producto.querySelector('.product__item__text h6 a').innerHTML,
           precio: producto.querySelector('.product__item__text .product__price').firstChild.nodeValue,
           cantidad: 1
       }
       if (articulosCarrito.some(producto => producto.titulo === infoProducto.titulo)) {
           const productos = articulosCarrito.map(producto => {
               if (producto.titulo === infoProducto.titulo) {
                   producto.cantidad++;
                   return producto;
               } else {
                   return producto;
               }
           })
           articulosCarrito = [...productos];
       } else {
           articulosCarrito = [...articulosCarrito, infoProducto];
       }
       cantidadCarrito.innerHTML = articulosCarrito.length;
       carritoHTML();
   }

   // Elimina el curso del carrito en el DOM
   function eliminarCurso(e) {
       e.preventDefault();
       if (e.target.classList.contains('borrar-curso')) {
           const productoTitulo = e.target.getAttribute('data-id')
           // Eliminar del arreglo del carrito
           articulosCarrito = articulosCarrito.filter(producto => producto.titulo !== productoTitulo);
           carritoHTML();
       }
   }

   // Muestra el curso seleccionado en el Carrito
   function carritoHTML() {
       vaciarCarrito();
       articulosCarrito.forEach(producto => {
           const row = document.createElement('tr');
           row.innerHTML = `
              <td>  
                    <img src="${producto.imagen}" width=100>
              </td>
              <td>${producto.titulo}</td>
              <td>${producto.precio}</td>
              <td>${producto.cantidad} </td>
              <td>
                    <a href="#" id="borrar-curso" class="borrar-curso" data-id="${producto.titulo}">X</a>
              </td>
         `;
           contenedorCarrito.appendChild(row);
       });
   }

   // Elimina los cursos del carrito en el DOM
   function vaciarCarrito() {
       while (contenedorCarrito.firstChild) {
           contenedorCarrito.removeChild(contenedorCarrito.firstChild);
       }
   }

   // Direccionamiento para los links
   function goto(url) {
       document.location = `${url}.html`;
   }