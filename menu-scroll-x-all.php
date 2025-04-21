<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <title>Podwójne menu scrollowane Vue 3</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      padding: 30px;
    }

    .menu-wrapper {
      display: flex;
      align-items: center;
      background-color: #333;
      padding: 5px;
      margin-bottom: 40px;
      border-radius: 8px;
    }

    .scroll-container {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      white-space: nowrap;
      flex-grow: 1;
      scrollbar-width: none;
    }

    .scroll-container::-webkit-scrollbar {
      display: none;
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
      border-radius: 4px;
    }

    /* Styl drugiego menu (pastelowy, zaokrąglony) */
    .pastel-wrapper {
      background-color: #ffffff;
      border: 1px solid #ccc;
    }

    .pastel-container .menu-item {
      padding: 12px 18px;
      background-color: #e9f7ff;
      color: #333;
      border-radius: 20px;
      margin: 5px;
      transition: background-color 0.3s;
    }

    .pastel-container .menu-item:hover {
      background-color: #d4efff;
    }

    .pastel-container .menu-item.active {
      background-color: #8fd1ff;
    }

    .pastel-container .scroll-btn {
      background-color: #8fd1ff;
      color: #222;
    }
	
	.blok-opisu {
  background: white;
  padding: 20px;
  margin-top: 10px;
}

  </style>
</head>
<body>



<div id="app1" style="width:500px;"></div>
<div id="app2" style="width:500px;"></div>

  <!-- Menu 1 -->
<template id="template1">
  <div>
    <div :class="['menu-wrapper', usePastel ? 'pastel-wrapper' : '']">
      <div :class="['scroll-container', usePastel ? 'pastel-container' : '']" ref="scrollContainer">
        <div
          class="menu-item"
          v-for="item in menuItems"
          :key="item.name + Math.random()"
          :class="{ active: activeItem === item.name }"
          @click="setActive(item.name)"
        >
          {{ item.label }}
        </div>
      </div>
      <button class="scroll-btn" @click="scrollRight">→</button>
    </div>

    <!-- Bloki opisów -->
    <div v-show="activeItem === 'home'" class="blok-opisu">Witamy na stronie głównej!</div>
    <div v-show="activeItem === 'about'" class="blok-opisu">O nas – poznaj nas lepiej.</div>
    <div v-show="activeItem === 'services'" class="blok-opisu">Nasze usługi.</div>
    <div v-show="activeItem === 'products'" class="blok-opisu">Nasze produkty.</div>
    <div v-show="activeItem === 'contact'" class="blok-opisu">Skontaktuj się z nami.</div>
    <div v-show="activeItem === 'faq'" class="blok-opisu">FAQ – pytania i odpowiedzi.</div>
    <div v-show="activeItem === 'blog'" class="blok-opisu">Blog – nasze wpisy.</div>
    <div v-show="activeItem === 'support'" class="blok-opisu">Wsparcie techniczne.</div>
    <div v-show="activeItem === 'terms'" class="blok-opisu">Regulamin i zasady.</div>
  </div>
</template>


  <!-- Menu 2 -->
<template id="template2">
  <div>
    <div :class="['menu-wrapper', usePastel ? 'pastel-wrapper' : '']">
      <div :class="['scroll-container', usePastel ? 'pastel-container' : '']" ref="scrollContainer">
        <div
          class="menu-item"
          v-for="item in menuItems"
          :key="item.name + Math.random()"
          :class="{ active: activeItem === item.name }"
          @click="setActive(item.name)"
        >
          {{ item.label }}
        </div>
      </div>
      <button class="scroll-btn" @click="scrollRight">→</button>
    </div>

    <!-- Bloki opisów -->
    <div v-show="activeItem === 'home'" class="blok-opisu">Witamy na stronie głównej!</div>
    <div v-show="activeItem === 'about'" class="blok-opisu">O nas – poznaj nas lepiej.</div>
    <div v-show="activeItem === 'services'" class="blok-opisu">Nasze usługi.</div>
    <div v-show="activeItem === 'products'" class="blok-opisu">Nasze produkty.</div>
    <div v-show="activeItem === 'contact'" class="blok-opisu">Skontaktuj się z nami.</div>
    <div v-show="activeItem === 'faq'" class="blok-opisu">FAQ – pytania i odpowiedzi.</div>
    <div v-show="activeItem === 'blog'" class="blok-opisu">Blog – nasze wpisy.</div>
    <div v-show="activeItem === 'support'" class="blok-opisu">Wsparcie techniczne.</div>
    <div v-show="activeItem === 'terms'" class="blok-opisu">Regulamin i zasady.</div>
  </div>
</template>

  <script>
    const { createApp, ref, onMounted, nextTick } = Vue;

function setupMenu(baseItems, usePastel = false, templateId = '#template1') {
  return {
    setup() {
      const scrollContainer = ref(null);
      const activeItem = ref(baseItems[0].name);

      const repeatCount = 5;
      const menuItems = ref(Array.from({ length: repeatCount }).flatMap(() => baseItems));

      // Opisy dla poszczególnych sekcji
      const descriptions = {
        home: "Witamy na stronie głównej! Tu znajdziesz najważniejsze informacje.",
        about: "Dowiedz się więcej o naszej firmie i zespole.",
        services: "Sprawdź nasze profesjonalne usługi dopasowane do Twoich potrzeb.",
        products: "Poznaj naszą ofertę produktów najwyższej jakości.",
        contact: "Skontaktuj się z nami! Czekamy na Twoją wiadomość.",
        faq: "Najczęściej zadawane pytania – znajdź odpowiedzi szybko.",
        blog: "Czytaj najnowsze wpisy na naszym blogu!",
        support: "Potrzebujesz pomocy? Nasz dział wsparcia jest tu dla Ciebie.",
        terms: "Zapoznaj się z naszym regulaminem."
      };

      const setActive = (name) => {
        activeItem.value = name;
      };

      const animateScroll = (container, distance, duration = 300) => {
        const start = container.scrollLeft;
        const startTime = performance.now();

        const step = (currentTime) => {
          const elapsed = currentTime - startTime;
          const progress = Math.min(elapsed / duration, 1);
          const ease = 0.5 - Math.cos(progress * Math.PI) / 2;
          container.scrollLeft = start + distance * ease;

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            const maxScroll = container.scrollWidth - container.clientWidth;
            if (container.scrollLeft >= maxScroll - 10) {
              container.scrollLeft = 0;
            }
          }
        };

        requestAnimationFrame(step);
      };

      const scrollRight = () => {
        if (scrollContainer.value) {
          animateScroll(scrollContainer.value, 300);
        }
      };

      onMounted(() => {
        const el = scrollContainer.value;
        if (!el) return;
        el.scrollLeft = 0;

        el.addEventListener('wheel', (e) => {
          if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
            e.preventDefault();
            el.scrollLeft += e.deltaY;
          }
        }, { passive: false });
      });

      return {
        scrollContainer,
        menuItems,
        activeItem,
        descriptions,
        setActive,
        scrollRight,
        usePastel
      };
    },
     template: templateId



  };
}


    const baseItems = [
      { name: 'home', label: 'Strona główna' },
      { name: 'about', label: 'O nas' },
      { name: 'services', label: 'Usługi' },
      { name: 'products', label: 'Produkty' },
      { name: 'contact', label: 'Kontakt' },
      { name: 'faq', label: 'FAQ' },
      { name: 'blog', label: 'Blog' },
      { name: 'support', label: 'Wsparcie' },
      { name: 'terms', label: 'Regulamin' }
    ];

createApp(setupMenu(baseItems, false, '#template1')).mount('#app1');
createApp(setupMenu(baseItems, true, '#template2')).mount('#app2');
  </script>
</body>
</html>
