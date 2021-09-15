<template>

    <!-- INIZIO  -->
    <div class="container-card">
      <div class="single-card">
        <img src="https://images.prismic.io/dbhq-deliveroo-riders-website/93c437b5-57bc-4222-848a-c748b6fbca92_Rider_Shoot_HD_Leuven-35.jpg?auto=compress,format" alt="Immagine rider">
        <div class="bottom-single-card">
          <h2>Rider</h2>
          <p>Diventa un rider: flessibilità, ottimi guadagni e un mondo di vantaggi per te.</p>          
        </div>
      </div>
      <div class="single-card">
        <img src="https://www.gasparina.org/wp-content/uploads/2021/01/work-with-us.jpg" alt="">
        <div class="bottom-single-card">
          <h2>Partnership</h2>
          <p>Diventa partner di Deliveroo e raggiungi sempre più clienti. Ci occupiamo noi della consegna, così che la tua unica preoccupazione sia continuare a preparare il miglior cibo.</p>          
        </div>
      </div>
      <div class="single-card">
        <img src="https://media.istockphoto.com/photos/asian-woman-working-in-call-center-office-picture-id1179186700?k=20&m=1179186700&s=612x612&w=0&h=AXlMt13t7cBHyQkKG0q1IQ4IrcpJD2fHe7Wu7-3UeO4=" alt="">
        <div class="bottom-single-card">
          <h2>Lavora con noi</h2>
          <p>La nostra missione è trasformare il modo in cui le persone mangiano. È un obiettivo ambizioso, come noi, e ci servono persone che ci aiutino a raggiungerlo.</p>          
        </div>
      </div>
    </div>
    <!-- FINE  -->

</template>

<script>
export default {
    name: "HomeCards"
}
</script>

<style lang="scss" scoped>
.container-card {
  display: flex;
  justify-content: space-around;
  margin: 5em 0;
}
.single-card {
  border-radius: 20% 1%;
  width: 30%;
  height: 500px;
  transition: 0.3s;
  box-shadow: -15px 15px 40px 0px;
  overflow: hidden;
  .bottom-single-card {
    padding: 20px 20px 0px;
  }
  &:hover {
    transform: scale(1.01);
    cursor: pointer;
     img,
    .bottom-single-card {
      box-shadow: 50px 50px 50px;
    }
  }
  &:first-child .bottom-single-card {
    background-color: #FF483B;
  }
  &:last-child .bottom-single-card{
    background-color: #BAC3C3;
  }
  img {
    width: 100%;
    height: 50%;
    clip-path: polygon(0 10%, 100% 0, 100% 89%, 0% 100%);
  }
  .bottom-single-card {
    height: 60%;
    color: white;
    clip-path: polygon(0 9%, 100% 0, 100% 100%, 0% 100%);
    position: relative;
    background-color: #FF8100;
    p {
      margin-bottom: 0;
      padding-bottom: 10px;
    }
  }
}




// media query
@media screen and (max-width: 960px) {
  .single-card {
    height: 450px;
    .bottom-single-card {
      padding: 20px 20px 40px;
      h2 {
        font-size: 1.5rem;
      }
      p {
        font-size: 0.8em;
      }
    }
  }
}

@media only screen and (max-width: 768px) {
  .single-card {
    height: 560px;
    img {
      height: 35%;
    }
    .bottom-single-card {
      clip-path: polygon(0 4%, 100% 0, 100% 100%, 0% 100%);
      height: 80%;
      padding: 25px 20px;
    }
  }
}

@media only screen and (min-width: 321px) and (max-width: 600px) {
  .container-card {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    margin: 40px 0;
    .single-card {
      width: 90%;
      margin: 20px auto;
      .bottom-single-card {
        clip-path: polygon(0 6%, 100% 0, 100% 90%, 0% 100%);
        padding: 40px 20px 40px;
        h2 {
          font-size: 2.5rem;
        }
        p {
          font-size: 1rem;
        }
      }
    }
  }
}
@media only screen and (min-width: 200px) and (max-width: 320px) {
.container-card {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    margin: 40px 0;
  .single-card {
    height: 800px;
    width: 100%;
    margin: 20px auto;
    .bottom-single-card {
      clip-path: polygon(0 5%, 100% 0, 100% 90%, 0% 100%);
      padding: 60px 20px 40px;
      h2 {
          font-size: 4rem;
        }
        p {
          font-size: 1.5rem;
        }
    }
  }
}
}

</style>