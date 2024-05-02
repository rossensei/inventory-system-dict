import { reactive, readonly, ref, computed } from 'vue';


const initialState = computed(() => parseInt(localStorage.getItem('count') || '0') || 0);
// Define your reactive state
const state = reactive({
  count: ref(initialState.value), // Wrap the initial value in a ref
  increment() {
    state.count++; // Access the value property of the ref
    localStorage.setItem('count', state.count.toString());
  },
  decrement() {
    state.count--;
    localStorage.setItem('count', state.count.toString());
  }
});

// Create a readonly version of the state to expose to components
const readonlyState = readonly(state);

export function useState() {
  // Expose the readonly state
  return readonlyState;
}
