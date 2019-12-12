<template>
    <div>
        <app-header></app-header>
        <section id="main" class="builder-elements">
            <div class="builder-element element-hero" id="home">
                <div class="element-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="element-header">
                                            <h1>Unique robot who forces you to work better & smarter</h1>
                                        </div>
                                        <div class="element-body">
                                            <p>unlimited work hours, documents and users</p>
                                        </div>
                                        <div class="element-footer text-center">
                                            <router-link to="/login-register" tag="a"class="btn btn-primary">
                                                Free trial
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="d-flex align-items-end justify-content-end hero-images clearfix">
                                    <img src="assets/img/desktop-view.png" alt="" class="desktop-view"/>
                                    <img src="assets/img/mobile-view.png" alt="" class="mobile-view"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="builder-element element-bg-img element-bg-left" id="about"
                 style="background-image: url(assets/img/bg-image-1.jpg)">
                <div class="element-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="element-header">
                                    <h3>Fusce fringilla mi eu nisl blandit</h3>
                                </div>
                                <div class="element-body">
                                    <div class="editor-content">
                                        <h5>Pellentesque maximus, dui dignissim rhoncus rutrum, purus felis vestibulum
                                            turpis,
                                            quis suscipit augue quam in odio. Vivamus convallis est enim, vitae
                                            hendrerit diam
                                            interdum ut.</h5>
                                        <p>Donec vel velit ut felis consequat tempus. Integer tempor nibh quam, sed
                                            sollicitudin
                                            massa iaculis ut. Sed suscipit augue nisl, sit amet vehicula ex finibus
                                            quis. Nulla
                                            quam mauris, interdum non ullamcorper in, tincidunt at ex. Morbi sagittis
                                            vehicula
                                            justo, vitae consequat ante sagittis nec.</p>
                                        <p>Cras sit amet erat non lacus viverra ultrices. Donec finibus purus tortor, in
                                            cursus
                                            erat aliquet nec. Vestibulum ante ipsum primis in faucibus orci luctus et
                                            ultrices
                                            posuere cubilia Curae.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import appHeader from './layout/Header';
    import appFooter from './layout/Footer';

    export default {
        components: {
            appHeader,
            appFooter
        }
    }
</script>
