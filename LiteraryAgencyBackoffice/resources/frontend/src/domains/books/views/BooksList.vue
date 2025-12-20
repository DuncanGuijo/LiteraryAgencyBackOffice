<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Books</h1>

    <table class="min-w-full bg-white border border-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 border-b">ID</th>
          <th class="px-4 py-2 border-b">Title</th>
          <th class="px-4 py-2 border-b">ISBN</th>
          <th class="px-4 py-2 border-b">Author ID</th>
          <th class="px-4 py-2 border-b">Agencies</th>
          <th class="px-4 py-2 border-b">Genres</th>
          <th class="px-4 py-2 border-b">Active</th>
          <th class="px-4 py-2 border-b">Publication Date</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="book in books"
          :key="book.id"
          class="hover:bg-gray-50"
        >
          <td class="px-4 py-2 border-b">{{ book.id }}</td>
          <td class="px-4 py-2 border-b">{{ book.title }}</td>
          <td class="px-4 py-2 border-b">{{ book.isbn }}</td>
          <td class="px-4 py-2 border-b">{{ book.author_id }}</td>
          <td class="px-4 py-2 border-b">{{ book.agencies_ids.join(', ') }}</td>
          <td class="px-4 py-2 border-b">{{ book.genres.join(', ') }}</td>
          <td class="px-4 py-2 border-b">{{ book.is_active ? 'Yes' : 'No' }}</td>
          <td class="px-4 py-2 border-b">{{ formatDate(book.publication_date) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue';
import { BookService } from '@/domains/books/services/BookService';
import type { BookDTO } from '@/domains/books/dtos/BookDTO';
import { formatDate } from '@/shared/utils/formatDate';

export default defineComponent({
  name: 'BooksList',
  setup() {
    const books = ref<BookDTO[]>([]);

    const loadBooks = async () => {
      try {
        books.value = await BookService.list();
      } catch (error) {
        console.error('Error loading books:', error);
      }
    };

    onMounted(loadBooks);

    return {
      books,
      formatDate,
    };
  },
});
</script>
