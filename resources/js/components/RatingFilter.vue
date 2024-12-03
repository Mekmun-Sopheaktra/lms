<template>
    <strong class="d-block mb-1">Select Ratings</strong>

    <div id="full-stars-example-two">
    <div class="rating-group">
        <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
        <label @click="applyRatingFilter(1)" aria-label="1 star" class="rating__label" for="rating3-1"><span class="rating__icon rating__icon--star fa fa-star"> <FontAwesomeIcon :icon="solidStar"></FontAwesomeIcon> </span></label>
        <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
        <label @click="applyRatingFilter(2)" aria-label="2 stars" class="rating__label" for="rating3-2"><span class="rating__icon rating__icon--star fa fa-star"> <FontAwesomeIcon :icon="solidStar"></FontAwesomeIcon> </span></label>
        <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
        <label @click="applyRatingFilter(3)" aria-label="3 stars" class="rating__label" for="rating3-3"><span class="rating__icon rating__icon--star fa fa-star"> <FontAwesomeIcon :icon="solidStar"></FontAwesomeIcon> </span></label>
        <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
        <label @click="applyRatingFilter(4)" aria-label="4 stars" class="rating__label" for="rating3-4"><span class="rating__icon rating__icon--star fa fa-star"> <FontAwesomeIcon :icon="solidStar"></FontAwesomeIcon> </span></label>
        <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
        <label @click="applyRatingFilter(5)" aria-label="5 stars" class="rating__label" for="rating3-5"><span class="rating__icon rating__icon--star fa fa-star"> <FontAwesomeIcon :icon="solidStar"></FontAwesomeIcon> </span></label>
        <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
    </div>
    </div>
</template>

<style lang="scss">
#full-stars-example-two {

  /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
  .rating-group {
    display: inline-flex;
  }

  /* make hover effect work properly in IE */
  .rating__icon {
    pointer-events: none;
    font-size: 25px;
  }

  /* hide radio inputs */
  .rating__input {
   position: absolute !important;
   left: -9999px !important;
  }

  /* hide 'none' input from screenreaders */
  .rating__input--none {
    display: none
  }

  /* set icon padding and size */
  .rating__label {
    cursor: pointer;
    padding: 0 0.1em;
    font-size: 2rem;
  }

  /* set default star color */
  .rating__icon--star {
    color: orange;
  }

  /* if any input is checked, make its following siblings grey */
  .rating__input:checked ~ .rating__label .rating__icon--star {
    color: #ddd;
  }

  /* make all stars orange on rating group hover */
  .rating-group:hover .rating__label .rating__icon--star {
    color: orange;
  }

  /* make hovered input's following siblings grey on hover */
  .rating__input:hover ~ .rating__label .rating__icon--star {
    color: #ddd;
  }
}

</style>


<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faStar as solidStar } from '@fortawesome/free-solid-svg-icons';
import { faStar as regularStar } from '@fortawesome/free-regular-svg-icons';

const router = useRouter();
const baseUrl = import.meta.env.VITE_APP_URL;
const instructors = ref([]);
const totalInstructors = ref(0);
const selectedInst = ref(0);
const emit = defineEmits(['RatingFilter']);
let ratings = ref([1, 2, 3, 4, 5]);
const selectedRating = ref(null);

function applyRatingFilter(id) {
    selectedRating.value = id;
    router.push('/courses');
    selectedInst.value = id;
    emit('RatingFilter', selectedInst.value);
}

// Fetch instructors
function fetchInstructors() {
    axios
        .get(`/instructor/list`, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then((res) => {
            instructors.value = res.data.data.instructors;
            totalInstructors.value = res.data.data.total_items;
        })
        .catch((error) => {
            console.error('Error fetching instructors:', error);
        });
}

onMounted(() => {
    fetchInstructors();
})
</script>
