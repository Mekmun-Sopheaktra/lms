<template>
    <section class="row">
        <section class="col-lg-6">
            <span class="d-block text-primary fw-bold mb-2">Find Your Answers</span>
            <h3 class="fw-bold">Have any thought?</h3>
            <h3 class="fw-bold mb-4">Look here.</h3>
            <p class="col-9 mb-5">Completely plagiarize fully researched collaboration and idea-sharing for covalent.
            </p>
            <router-link to="/page/faq" class="btn rounded-pill fw-bold read-more-btn">Read More <i
                    class="bi bi-arrow-right ms-1"></i></router-link>
        </section>
        <section class="col-lg-6">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item p-2 mb-3">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            How to delete my account?
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                            body.</div>
                    </div>
                </div>
                <div class="accordion-item p-2 mb-3">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            How can I deactivate my account?
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                            body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item p-2 mb-3">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                            body. Nothing more exciting happening here in terms of content, but just filling up the
                            space to make it look, at least at first glance, a bit more representative of how this would
                            look in a real-world application.</div>
                    </div>
                </div>
                <div class="accordion-item p-2 mb-3">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                            aria-controls="flush-collapseFour">
                            How can I reactive my account?
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<style scoped lang="scss">
.read-more-btn {
    border: 1px solid #777;

    &:hover {
        background-color: #9E4AED;
        color: #fff;
    }
}

.accordion-item {
    box-shadow: 0px 12px 48px 0px #0000000D;
    border: 0;
    border-radius: 10px;

    .accordion-header {
        .accordion-button {
            border-radius: 10px !important;
        }
    }
}
</style>
