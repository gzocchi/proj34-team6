<template>
  <footer class="container-fluid">
    <section class="">
      <!--Grid row-->
      <div class="row justify-content-center">
        <!--Grid column-->
        <div class="footer-item col-lg-2 col-md-4 col-sm-4 col-12 mb-4 mt-6 mx-2">
          <h3>Scopri Deliveroo</h3>
          <ul class="list-unstyled mb-0">
             <li><a href="#">Investitori</a></li>
             <li><a href="#">Chi Siamo</a></li>
             <li><a href="#">Ristoranti</a></li>
             <li><a href="#">Altro</a></li>
             <li><a href="#">Pressroom</a></li>
             <li><a href="#">Il nostro blog</a></li>
             <li><a href="#">Programmazione</a></li>
             <li><a href="#">Design</a></li>
             <li><a href="#">Lavora con noi</a></li>
             <li><a href="#">Diventa un nostro partner</a></li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="footer-item col-lg-2 col-md-4 col-sm-4 col-12 mb-4 mb-4 mt-6 mx-2">
            <h3>Note legali</h3>
            <ul class="list-unstyled mb-0">
              <li><a href="#">Termini e Condizioni</a></li>
              <li><a href="#">Informativa sulla privacy</a></li>
              <li><a href="#">Cookies</a></li>
            </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="footer-item col-lg-2 col-md-4 col-sm-4 col-12 mb-4 mb-4 mt-6 mx-2">
          <h3>Aiuto</h3>
          <ul class="list-unstyled mb-0">
            <li><a href="#">Contatti</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Tipi di Cucina</a></li>
            <li><a href="#">Mappa del sito</a></li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="footer-item col-lg-2 col-md-4 col-sm-4 col-12 mb-4 mb-4 mt-6 mx-2">
          <h3>Porta Deliveroo con te</h3>
          <a href="https://apps.apple.com/it/app/deliveroo-consegne-di-cibo/id1001501844" target="_blank">
            <img src="http://www.mondino.it/wp-content/uploads/2019/05/app-store-badge.png"  width="80%" alt="">
          </a>
          <a href="https://play.google.com/store/apps/details?id=com.deliveroo.orderapp&hl=it&gl=US" target="_blank">
            <img src="https://supermercatideco.multicedi.it/immagini/android.png" width="80%" alt="">
          </a>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!-- Section: Links -->

  <!-- Grid container -->

  <!-- Copyright -->
  <div class="p-3 text-center">
   <a class="m-1" href="https://m.facebook.com/Deliveroo/?locale2=it_IT"  target="_blank" role="button">
     <img src="https://icons.veryicon.com/png/o/application/common-icons/facebook-129.png" width="30px" alt="" class="social">
   </a>
   <a class="m-1" href="https://www.instagram.com/deliveroo_italy/?hl=it" target="_blank" role="button">
     <img class="social" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Instagram.svg/1200px-Instagram.svg.png" width="30px" alt="">
   </a>
   <a class="m-1" href="https://twitter.com/Deliveroo_Italy?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank" role="button">
     <img class="social" src="https://upload.wikimedia.org/wikipedia/sco/thumb/9/9f/Twitter_bird_logo_2012.svg/1200px-Twitter_bird_logo_2012.svg.png" width="30px" alt="">
   </a>
  </div>
  <div class="container text-center text-secondary">
    <p>Made by Boolean class#34 team 6</p>
  </div>
  </footer>
</template>

<script>

export default {
  name: "Footer",
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

footer {
  width: 100%;
  background-color: $footer_black;
  padding-top: 5rem;
  .footer-item {
   min-height: 350px;
   background-color: $footer_grey;
   padding: 10px;
   border-radius:3px;
   color: white;
   h3 {
     font-size:18px;
     font-weight: 800;
     margin:10px;
   }
   ul {
     list-style: none;
     margin: 0 10px;
     li {
       margin: .3rem 0;
       a {
         text-decoration: none;
         color: white;
         font-weight: 300;
       }
     } 
   }
  }
  .social {
    filter: grayscale(100%) saturate(100%) brightness(200%);
    transition: ease-out .4s;
  }
  .social:hover {
    filter: none;
  } 
}
</style>