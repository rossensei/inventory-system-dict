import { ref } from 'vue';
import store from '../store.js';

export function useCollapse() {
    const collapsedCategories = ref(store.collapsedCategories);

    const toggleCollapse = (categoryId) => {
        let index = collapsedCategories.value.indexOf(categoryId);

        if(!collapsedCategories.value.includes(categoryId)) {
            collapsedCategories.value.push(categoryId);
        } else {
            collapsedCategories.value.splice(index, 1);
        }

        store.collapsedCategories = collapsedCategories.value;
    }

    return {
        toggleCollapse,
    }
}
