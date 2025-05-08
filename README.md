# 🔁 Vue 3 – Menu z Przewijaniem

Projekt demonstruje trzy wersje poziomego menu zbudowanego w Vue 3. Każde z nich różni się stylem i logiką przewijania — od klasycznego z przyciskami, przez nieskończone przewijanie, aż po lekką, pastelową wersję. Wszystkie menu wspierają przewijanie myszą i płynną animację.

---

## 🔗 Live Demo

👉 [Zobacz demo](http://company12.atwebpages.com/?next=menu-scroll-x)  
👉 [Zobacz demo](http://company12.atwebpages.com/?next=menu-scroll-x-all) 

## 📝 Uwagi dotyczące stylów demonstracyjnych

W przykładowym pliku HTML, kontener `#app` został opatrzony tymczasowym stylem:

```html
<body>
<div id="app" style="width:500px;">
```
### 🚀 Szybki start

Nie wymaga instalacji – wystarczy otworzyć plik HTML z `Vue 3 CDN`:

```html
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
```
---

## 🧲 Menu 1 – Scroll z przyciskami lewo/prawo

- 🧭 Statyczna lista (bez powielania zakładek)
- 🔘 Przycisk `←` i `→` przewija menu z animacją
- 🧠 Przycisk `←` znika przy scrollLeft = 0, `→` znika przy końcu
- 🔄 Scroll-behavior + aktualizacja widoczności przy resize/scroll

---

## 🧭 Menu 2 – Klasyczne (Powielone zakładki, nieskończone przewijanie)

- 🔁 Zakładki są powielone (np. 5x), by umożliwić długie przewijanie w prawo
- 🧠 Reset scrolla po dojściu do końca (płynnie wraca na początek)
- 🖱️ Obsługa scrolla myszą (wheel → poziomy scroll)
- 🔘 Przycisk `→` przewija animacyjnie w prawo

---

## 🌸 Menu 3 – Pastelowe z zaokrągleniami

- 🎨 Styl pastelowy, z `border-radius`, inną kolorystyką i animacjami
- 🔁 Ten sam mechanizm co w menu 1, ale inna prezentacja
- 💡 Idealne jako „lekka” wersja np. na mobilki lub bloga

---

## ✨ Funkcje

- ✅ Vue 3 Composition API
- ✅ Fizyczne powielanie zakładek (`baseItems + baseItems`)
- ✅ Nieskończone przewijanie w prawo
- ✅ Obsługa `scroll-behavior: smooth`
- ✅ Reset scrolla po osiągnięciu końca
- ✅ Przewijanie za pomocą kółka myszy (wheel event)
- ✅ Brak scrollbara – tylko przycisk i mysz

---

## 📦 Struktura

- `baseItems`: oryginalna lista zakładek
- `menuItems`: duplikat `baseItems` użyty do efektu pętli
- `scrollRight()`: uruchamia płynne przewinięcie
- `animateScroll()`: animuje przewijanie (easeInOut)
- `wheel event`: przewija poziomo kółkiem myszy

---

## 🧪 Użycie

1. Kliknij `→`, aby przesunąć zakładki
2. Po osiągnięciu końca lista resetuje się do początku
3. Możesz również przewijać zakładki poziomo za pomocą myszy lub touchpada

---

## 📝 Uwagi

- Styl `width: 500px` dla `#app` ma charakter wyłącznie demonstracyjny.
- Zakładki są powielane ręcznie (`[...items, ...items]`) – można dodać więcej cykli.
- Przewijanie myszą działa również na touchpadach (Mac/Windows).

---

## 🧩 Rozbudowa

- Auto-scroll (carousel) z `setInterval`
- Detekcja aktywnej zakładki w widoku
- Komponent `InfiniteScrollMenu.vue`
- Lazy loading większych list

---

## 📄 Licencja

Projekt testowo-edukacyjny – możesz używać, modyfikować i rozszerzać dowolnie.

---

## 🔗 Strona domowa

Webmaster: [asperion](http://asperion24.eu/)

📅 Data utworzenia: 2025-04-19
