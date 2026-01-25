<template class="list-page">    
  <h1 class="text-3xl font-bold mb-6 text-gray-800">Books</h1>

  <section class="table-wrapper bg-gray-50 shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-linear-to-r from-indigo-200 to-indigo-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">ID</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Title</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Author ID</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">ISBN</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Active</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Publication Date</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Agencies</th>
          <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Genres</th>
          <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr
          v-for="book in books"
          :key="book.id ?? book.title"
          class="odd:bg-gray-50 even:bg-gray-100 hover:bg-indigo-50 transition-colors duration-200"
        >
          <td class="px-6 py-3 text-sm font-medium text-indigo-700 hover:underline cursor-pointer">
            {{ book.id }}
          </td>
          <td class="px-6 py-3 text-sm text-gray-800 font-semibold">{{ book.title }}</td>
          <td class="px-6 py-3 text-sm text-gray-700">{{ book.author_id }}</td>
          <td class="px-6 py-3 text-sm text-gray-700">{{ book.isbn }}</td>
          <td class="px-6 py-3 text-sm font-semibold" :class="book.is_active === 1 ? 'text-green-600' : 'text-red-500'">
            {{ book.is_active === 1 ? 'Yes' : 'No' }}
          </td>
          <td class="px-6 py-3 text-sm text-gray-700">{{ book.publication_date ? formatDate(book.publication_date) : '-' }}</td>
          <td class="px-6 py-3 text-sm text-gray-700">{{ book.agencies_ids.join(', ') }}</td>
          <td class="px-6 py-3 text-sm text-gray-700">{{ book.genres.join(', ') }}</td>
          <td class="px-6 py-3 text-center">
            <button class="text-indigo-600 hover:text-indigo-900 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 1v6m-3 3h6" />
              </svg>
            </button>
          </td>
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
import type { BookDTO } from '@/domains/books/dtos/BookDTO';
import { BookService } from '@/domains/books/services/BookService';
import { formatDate } from '@/shared/utils/formatDate';
import Pagination from '@/layouts/components/tables/Pagination.vue';
import type { Meta } from '@/shared/types/Pagination';

export default {
  components: {
    Pagination
  },
  setup() {
    const books = ref<BookDTO[]>([]);
    const meta = ref<Meta>({
      current_page: 1,
      per_page: 5,
      total: 0,
      last_page: 1,
    });

    const loadBooks = async () => {
      try {
        const res = await BookService.getBooks(meta.value.current_page, meta.value.per_page);
        books.value = res.data;
        meta.value = res.meta;
      } catch (error) {
        console.error('Failed to load books:', error);
      }
    };

    const nextPage = () => {
      if (meta.value.current_page < meta.value.last_page) {
        meta.value.current_page++;
        loadBooks();
      }
    };

    const prevPage = () => {
      if (meta.value.current_page > 1) {
        meta.value.current_page--;
        loadBooks();
      }
    };

    onMounted(loadBooks);

    return {
      books,
      meta,
      nextPage,
      prevPage,
      formatDate,
    };
  },
};
</script>