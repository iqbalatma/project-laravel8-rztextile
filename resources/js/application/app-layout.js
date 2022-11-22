$(document).ready(function(){
  const sidebarMenu = $("#sidebar-menu a");
  let currentUrl = location.href.split('?')[0]

  console.log(currentUrl);
  console.log(sidebarMenu);


  sidebarMenu.each(function(){
    let sidebarUrl = $(this).attr("href");
    if(sidebarUrl === currentUrl){
      $(this).addClass("active");
    }
  });
});