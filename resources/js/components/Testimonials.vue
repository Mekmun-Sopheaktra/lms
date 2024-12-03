<template>
    <div id="testimonialCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="col-9 mx-auto bg-white p-5 testimonial">
                    <div class="d-flex align-items-center">
                        <img :src="'/assets/images/website/testimonial_1.png'" class="profile-picture" height="192px"
                            width="192px">
                        <div class="w-100 px-5">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <strong class="d-block">Lori R. Briggs</strong>
                                    <small class="text-muted">Student</small>
                                </div>
                                <div>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <strong class="ms-2">5.0</strong>
                                </div>
                            </div>
                            <p>I am proud to say that after a few months of taking this course...I passed my exam and am
                                now an AWS Certified Cloud Practitioner! This content was exactly what the CCP exam
                                covered.</p>
                        </div>
                    </div>
                    <i class="bi bi-quote display-1 position-absolute quote-icon"></i>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-9 mx-auto bg-white p-5 testimonial">
                    <div class="d-flex align-items-center">
                        <img :src="'/assets/images/website/testimonial_1.png'" class="profile-picture" height="192px"
                            width="192px">
                        <div class="w-100 px-5">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <strong class="d-block">Lori R. Briggs</strong>
                                    <small class="text-muted">Student</small>
                                </div>
                                <div>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <strong class="ms-2">5.0</strong>
                                </div>
                            </div>
                            <p>I am proud to say that after a few months of taking this course...I passed my exam and am
                                now an AWS Certified Cloud Practitioner! This content was exactly what the CCP exam
                                covered.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-9 mx-auto bg-white p-5 testimonial">
                    <div class="d-flex align-items-center">
                        <img :src="'/assets/images/website/testimonial_1.png'" class="profile-picture" height="192px"
                            width="192px">
                        <div class="w-100 px-5">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <strong class="d-block">Lori R. Briggs</strong>
                                    <small class="text-muted">Student</small>
                                </div>
                                <div>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <strong class="ms-2">5.0</strong>
                                </div>
                            </div>
                            <p>I am proud to say that after a few months of taking this course...I passed my exam and am
                                now an AWS Certified Cloud Practitioner! This content was exactly what the CCP exam
                                covered.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev text-dark w-25" type="button" data-bs-target="#testimonialCarousel"
            data-bs-slide="prev">
            <span class="bg-white px-2 py-1 border rounded-circle theme-shadow"><i
                    class="bi bi-chevron-left"></i></span>
        </button>
        <button class="carousel-control-next text-dark w-25" type="button" data-bs-target="#testimonialCarousel"
            data-bs-slide="next">
            <span class="bg-white px-2 py-1 border rounded-circle theme-shadow"><i
                    class="bi bi-chevron-right"></i></span>
        </button>
    </div>
</template>

<style scoped lang="scss">
.testimonial {
    border-radius: 2rem;
    box-shadow: 0px 16px 64px 0px #9747FF14;

    .profile-picture {
        border-radius: 1rem;
    }

    .quote-icon {
        color: #9747ff27;
        right: 20%;
        top: 80%;
    }
}
</style>
