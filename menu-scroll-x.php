<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <title>Menu z przewijaniem w lewo i prawo</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .menu-wrapper {
      display: flex;
      align-items: center;
      background-color: #333;
      padding: 0 5px;
      position: relative;
    }

    .scroll-container {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      white-space: nowrap;
      flex-grow: 1;
      scrollbar-width: none; /* Firefox */
    }

    .scroll-container::-webkit-scrollbar {
      display: none; /* Chrome, Safari */
    }

    .menu-item {
      padding: 14px 20px;
      color: white;
      cursor: pointer;
      flex-shrink: 0;
    }

    .menu-item:hover {
      background-color: #444;
    }

    .menu-item.active {
      background-color: #007bff;
    }

    .scroll-btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 14px;
      cursor: pointer;
      font-size: 18px;
      user-select: none;
    }

    .scroll-btn:disabled {
      opacity: 0.4;
      cursor: default;
    }
  </style>
</head>
<body>
  <div id="app" style="width:500px;">
    <div class="menu-wrapper">
      <button class="scroll-btn" v-if="showLeft" @click="scrollLeft">←</button>
      <div class="scroll-container" ref="scrollContainer">
        <div
          class="menu-item"
          v-for="item in menuItems"
          :key="item.name"
          :class="{ active: activeItem === item.name }"
          @click="setActive(item.name)"
        >
          {{ item.label }}
        </div>
      </div>
<button class="scroll-btn" v-if="showRight" @click="scrollRight">→</button>
    </div>

    <div class="content" style="padding: 20px;">
      <h2>Aktualna sekcja: {{ activeItem }}</h2>
    </div>
  </div>

 <script>
  const { createApp, ref, onMounted, onBeforeUnmount } = Vue;

  createApp({
    setup() {
      const showLeft = ref(false);
      const showRight = ref(false);
      const scrollContainer = ref(null);

      const menuItems = ref([
        { name: 'home', label: 'Strona główna' },
        { name: 'about', label: 'O nas' },
        { name: 'services', label: 'Usługi' },
        { name: 'products', label: 'Produkty' },
        { name: 'contact', label: 'Kontakt' },
        { name: 'faq', label: 'FAQ' },
        { name: 'blog', label: 'Blog' },
        { name: 'support', label: 'Wsparcie' },
        { name: 'terms', label: 'Regulamin' },
      ]);

      const activeItem = ref('home');

      const setActive = (name) => {
        activeItem.value = name;
      };

      const updateScrollButtons = () => {
        const el = scrollContainer.value;
        if (!el) return;

        showLeft.value = el.scrollLeft > 0;
        showRight.value = el.scrollLeft + el.clientWidth < el.scrollWidth - 1;
      };

      function animateScroll(container, distance, duration = 300) {
        const start = container.scrollLeft;
        const startTime = performance.now();

        function step(currentTime) {
          const elapsed = currentTime - startTime;
          const progress = Math.min(elapsed / duration, 1);
          const ease = 0.5 - Math.cos(progress * Math.PI) / 2;

          container.scrollLeft = start + distance * ease;

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            updateScrollButtons(); // aktualizuj po zakończeniu animacji
          }
        }

        requestAnimationFrame(step);
      }

      const scrollRight = () => {
        if (scrollContainer.value) {
          animateScroll(scrollContainer.value, 300);
        }
      };

      const scrollLeft = () => {
        if (scrollContainer.value) {
          animateScroll(scrollContainer.value, -300);
        }
      };

      onMounted(() => {
        updateScrollButtons();
        scrollContainer.value.addEventListener('scroll', updateScrollButtons);
        window.addEventListener('resize', updateScrollButtons);
      });

      onBeforeUnmount(() => {
        scrollContainer.value?.removeEventListener('scroll', updateScrollButtons);
        window.removeEventListener('resize', updateScrollButtons);
      });

      return {
        menuItems,
        activeItem,
        setActive,
        scrollContainer,
        scrollRight,
        scrollLeft,
        showLeft,
        showRight,
      };
    }
  }).mount('#app');
</script>

</body>
</html>
