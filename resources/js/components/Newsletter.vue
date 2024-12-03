<template>
    <section class="position-relative z-1 rounded-pill p-5 newsletter">
        <div class="row">
            <div class="col-6 my-auto pe-lg-5">
                <h3 class="fw-bold">Don't Miss Update</h3>
                <p>Stay connected with us to keep yourself updated. Subscribe to our newsletter to get great offers and
                    updates!</p>
            </div>
            <div class="col-6 my-auto ps-lg-5">
                <form class="input-group" role="search">
                    <input class="form-control search-input border-0 search-input" type="email"
                        placeholder="Enter your email">
                    <div class="bg-white search-btn-wrapper">
                        <button type="submit" class="btn btn-dark rounded-pill border-3 border-white">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
.newsletter {
    background-image: url('/assets/images/website/newsletter-bg.svg');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    color: white;

    .search-input {
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;

        &::placeholder {
            color: #868686;
        }
    }

    .search-btn-wrapper {
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;

        button {
            padding-left: 30px;
            padding-right: 30px;
        }
    }
}
</style>
