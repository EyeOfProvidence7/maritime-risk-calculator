<template>
  <div class="risk-checker">
    <h2>🌊 Maritime Route Risk Checker</h2>

    <form @submit.prevent="checkRisk">
      <label>
        Start Port:
        <input v-model="start" required />
      </label>
      <label>
        End Port:
        <input v-model="end" required />
      </label>
      <button type="submit">Check Risk</button>
    </form>

    <div v-if="segments.length" class="results">
      <h3>🧭 Route Risk Analysis</h3>
      <ul>
        <li
          v-for="(segment, index) in segments"
          :key="index"
          :style="{ color: getColor(segment.risk) }"
        >
          {{ segment.location }} — 💨 {{ segment.wind }} Beaufort — ⚠️ Risk: {{ segment.risk }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const start = ref('');
const end = ref('');
const segments = ref<any[]>([]);

const checkRisk = async () => {
  segments.value = [];
  const response = await fetch('http://localhost:8000/api/risk', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ start: start.value, end: end.value }),
  });

  if (!response.ok) {
    alert('Failed to fetch risk data');
    return;
  }

  segments.value = await response.json();
};

const getColor = (risk: string): string => {
  switch (risk) {
    case 'Safe':
      return 'green';
    case 'Caution':
      return 'orange';
    case 'Danger':
      return 'red';
    default:
      return 'black';
  }
};
</script>

<style scoped>
.risk-checker {
  max-width: 500px;
  margin: 2rem auto;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 0.5rem;
  font-family: sans-serif;
}

form {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

input {
  padding: 0.3rem;
}

button {
  margin-top: 0.5rem;
  padding: 0.4rem;
}

.results ul {
  list-style-type: none;
  padding-left: 0;
}
</style>
