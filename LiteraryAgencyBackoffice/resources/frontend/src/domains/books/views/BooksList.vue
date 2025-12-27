<template>
  <div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Books</h1>

    <table class="min-w-full border-collapse border border-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">Title</th>
          <th class="px-4 py-2 text-left">Author ID</th>
          <th class="px-4 py-2 text-left">ISBN</th>
          <th class="px-4 py-2 text-left">Active</th>
          <th class="px-4 py-2 text-left">Publication Date</th>
          <th class="px-4 py-2 text-left">Agencies</th>
          <th class="px-4 py-2 text-left">Genres</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="book in books"
          :key="book.id ?? book.title"
          class="border-b"
        >
          <td class="px-4 py-2">{{ book.id }}</td>
          <td class="px-4 py-2">{{ book.title }}</td>
          <td class="px-4 py-2">{{ book.author_id }}</td>
          <td class="px-4 py-2">{{ book.isbn }}</td>
          <td class="px-4 py-2">{{ book.is_active === 1 ? 'Yes' : 'No' }}</td>
          <td class="px-4 py-2">{{ book.publication_date ? formatDate(book.publication_date) : '-' }}</td>
          <td class="px-4 py-2">{{ book.agencies_ids.join(', ') }}</td>
          <td class="px-4 py-2">{{ book.genres.join(', ') }}</td>
        </tr>
      </tbody>
    </table>

    <div class="flex justify-between items-center mt-4">
      <button
        class="px-4 py-2 bg-gray-300 text-black rounded disabled:opacity-50"
        :disabled="meta.current_page <= 1"
        @click="prevPage"
      >
        Previous
      </button>

      <span>Page {{ meta.current_page }} of {{ meta.last_page }}</span>

      <button
        class="px-4 py-2 bg-gray-300 text-black rounded disabled:opacity-50"
        :disabled="meta.current_page >= meta.last_page"
        @click="nextPage"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from 'vue';
import type { BookDTO } from '@/domains/books/dtos/BookDTO';
import { BookService } from '@/domains/books/services/BookService';
import { formatDate } from '@/shared/utils/formatDate';

interface Meta {
  current_page: number;
  per_page: number;
  total: number;
  last_page: number;
}

export default {
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

<style scoped>
table th,
table td {
  border: 1px solid #e5e7eb;
}
</style>
