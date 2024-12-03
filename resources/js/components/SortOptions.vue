<template>
    <strong class="d-block mb-3">Sort By</strong>
    <ul class="list-unstyled">
        <li>
            <div class="form-check mb-2">
                <input
                    checked
                    @change="emit('sort', null, null)"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault1"
                />
                <label class="form-check-label" for="flexRadioDefault1">
                    Relevance (Default)
                </label>
            </div>
        </li>
        <li>
            <div class="form-check mb-2">
                <input
                    @change="emit('sort', 'price', 'desc')"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                />
                <label class="form-check-label" for="flexRadioDefault2">
                    Course Fee: High to Low
                </label>
            </div>
        </li>
        <li>
            <div class="form-check mb-2">
                <input
                    @change="emit('sort', 'price', 'asc')"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault3"
                />
                <label class="form-check-label" for="flexRadioDefault3">
                    Course Fee: Low to High
                </label>
            </div>
        </li>
        <li>
            <div class="form-check mb-2">
                <input
                    @change="emit('sort', 'view_count', 'desc')"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault4"
                />
                <label class="form-check-label" for="flexRadioDefault4">
                    Popular Courses
                </label>
            </div>
        </li>
        <li>
            <div class="form-check mb-2">
                <input
                    @change="emit('sort', 'published_at', 'desc')"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault5"
                />
                <label class="form-check-label" for="flexRadioDefault5">
                    Newest Courses
                </label>
            </div>
        </li>
        <!-- <li>
            <div class="form-check mb-2">
                <input @input="emit('sort', property, order);" class="form-check-input" type="radio"
                    name="flexRadioDefault" id="flexRadioDefault6">
                <label class="form-check-label" for="flexRadioDefault6">
                    Best Selling Courses
                </label>
            </div>
        </li> -->
        <li>
            <div class="form-check mb-2">
                <input
                    @change="emit('sort', 'average_rating', 'desc')"
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault7"
                />
                <label class="form-check-label" for="flexRadioDefault7">
                    Rating
                </label>
            </div>
        </li>
    </ul>
</template>

<script setup>
const emit = defineEmits(["sort"]);
</script>
