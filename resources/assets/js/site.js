// const sidebar = document.querySelector(".sidebar")
// const hambergerMenu = document.querySelector(".ham-menu")
// const overlay = document.querySelector(".overlay")
// const search = document.querySelector(".search")
//
// const toggleSidebar = ()=>{
//     if(sidebar.style.right == '0px') {
//         sidebar.style.right = "-250px"
//         overlay.style.opacity = 0
//         overlay.style.visibility = "hidden"
//         return
//     }
//     sidebar.style.right = 0
//     overlay.style.opacity = 1
//     overlay.style.visibility = "visible"
//
// }
//
// hambergerMenu.onclick = toggleSidebar
// overlay.onclick = toggleSidebar
// search.onclick = toggleSidebar
//
//
//
//
//
//
// var swiper = new Swiper(".mySwiper", {
//     navigation: {
//         nextEl: ".swiper-button-prev",
//         prevEl: ".swiper-button-next",
//     },
//     slidesPerView: 1,
//     breakpoints: {
//         // When window width is <= 767px
//         767: {
//             slidesPerView: 2,
//             spaceBetween: 10
//         },
//         // When window width is <= 992px
//         992: {
//             slidesPerView: 3,
//             spaceBetween: 20
//         },
//         1200: {
//             slidesPerView: 4,
//             spaceBetween: 20
//         },
//         1400: {
//             slidesPerView: 5,
//             spaceBetween: 20
//         }
//     }
// });
//
//
// // Initialize the map
// var mymap = L.map('map').setView([32.4279, 53.6880], 6);
//
// // Add a tile layer
// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
//     maxZoom: 18,
// }).addTo(mymap);
//
// L.marker([35.6892, 51.3890]).addTo(mymap)
//     .bindPopup('Tehran, Iran')
//     .openPopup();
//
