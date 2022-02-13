<template>
  <div>
    <!-- banner -->
    <div class="content">
      <div class="container-fluid">
        <div
          id="carouselExampleIndicators"
          class="carousel slide row"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              data-target="#carouselExampleIndicators"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                class="d-block w-100"
                src="/dashboard/dist/img/banner.jpg"
                alt="First slide"
              />
              <div class="carousel-caption d-none d-md-block">
                <h4>Welcome To</h4>
                <h6>Blogs</h6>
                <p>...</p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                class="d-block w-100"
                src="/dashboard/dist/img/banner.jpg"
                alt="Second slide"
              />
              <div class="carousel-caption d-none d-md-block">
                <h4>Welcome To My Portfolio</h4>
                <p>...</p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                class="d-block w-100"
                src="/dashboard/dist/img/banner.jpg"
                alt="Third slide"
              />
              <div class="carousel-caption d-none d-md-block">
                <h5>
                  I am Sehzade Tezz (Tejendra Dangaura) Full Stack Developer
                </h5>
                <p>...</p>
              </div>
            </div>
          </div>
          <a
            class="carousel-control-prev"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a
            class="carousel-control-next"
            href="#carouselExampleIndicators"
            role="button"
            data-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>