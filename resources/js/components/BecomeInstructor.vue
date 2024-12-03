<template>
    <div class="call-to-action col-10 mx-auto row align-items-center rounded-5 px-4 py-5 mb-5 mb-lg-auto">
        <div class="col-lg-6 text-center">
            <img :src="'/assets/images/website/become-instructor.png'" width="391px" height="467px"
                alt="Become instructor">
        </div>
        <div class="col-lg-6">
            <h3 class="fs-1 fw-bold mb-4">Become an Instructor and Teach Online</h3>
            <p class="mb-5">Helping employees gain skills and providing career development often take a back seat to
                business priorities but workplace.</p>
            <router-link to="/register" class="btn btn-primary rounded-pill">Join Now</router-link>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.call-to-action {
    box-shadow: 0px 16px 64px 0px #00000014;
}
</style>
