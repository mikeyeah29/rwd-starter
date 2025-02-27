<?php
/* Template Name: Site Map */
?>

<?php get_header(); ?>

<style>

    a {
        font-size: 20px;
        display: block;
        margin-bottom: 15px;
    }

    .done {
        color: #FE1F0F;
    }

</style>

<main class="py-5">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">

                <!-- Pages Section -->
                <section class="mb-5">
                    <h2 class="h1">Pages</h2>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-decoration-none done">Home</a></li>
                        <li><a href="/contact" class="text-decoration-none">Contact</a></li>
                    </ul>
                </section>

            </div>

            <div class="col-sm-6">

            </div>

        </div>

    </div>
</main>

<?php get_footer(); ?>
