<template class="list-page"> 
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Genres</h1>

    <section class="table-wrapper bg-gray-50 shadow-md rounded-lg overflow-hidden border border-gray-200">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-linear-to-r from-indigo-200 to-indigo-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Active</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="genre in genres"
            :key="genre.id ?? genre.name"
            class="odd:bg-gray-50 even:bg-gray-100 hover:bg-indigo-50 transition-colors duration-200"
          >
            <td class="px-6 py-3 text-sm font-medium text-indigo-700 hover:underline cursor-pointer">{{ genre.id }}</td>
            <td class="px-6 py-3 text-sm font-medium text-indigo-700 hover:underline cursor-pointer">{{ genre.name }}</td>
            <td class="px-6 py-3 text-sm font-semibold" :class="genre.is_active === 1 ? 'text-green-600' : 'text-red-500'">{{ genre.is_active ? 'Yes' : 'No' }}</td>
          </tr>
        </tbody>
      </table>
      <div class="m-2">
        <Pagination :meta="meta" @next="nextPage" @prev="prevPage" />
      </div>
    </section>
</template>

<script lang="ts">
import { ref, onMounted } from 'vue';
import { GenreService } from '@/domains/genres/services/GenreService';
import { formatDate } from '@/shared/utils/formatDate';
import type { GenreDTO } from '../dtos/GenreDTO';
import Pagination from '@/layouts/components/tables/Pagination.vue';
import type { Meta } from '@/shared/types/Pagination';

export default {
  components: {
    Pagination
  },
  setup() {
    const genres = ref<GenreDTO[]>([]);
    const meta = ref<Meta>({
      current_page: 1,
      per_page: 5,
      total: 0,
      last_page: 1,
    });

    const loadGenres = async () => {
      try {
        const res = await GenreService.getGenres(meta.value.current_page, meta.value.per_page);
        genres.value = res.data;
        meta.value = res.meta;
      } catch (error) {
        console.error('Failed to load genres:', error);
      }
    };

    const nextPage = () => {
      if (meta.value.current_page < meta.value.last_page) {
        meta.value.current_page++;
        loadGenres();
      }
    };

    const prevPage = () => {
      if (meta.value.current_page > 1) {
        meta.value.current_page--;
        loadGenres();
      }
    };

    onMounted(loadGenres);
    return {
      genres,
      meta,
      nextPage,
      prevPage,
      formatDate,
    };
  },
};
</script>
