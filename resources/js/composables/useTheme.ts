import { onMounted, ref } from "vue";

export function useTheme() {
  const isDark = ref(false);

  const apply = (dark: boolean) => {
    isDark.value = dark;
    document.documentElement.classList.toggle("dark", dark);
    localStorage.setItem("theme", dark ? "dark" : "light");
  };

  onMounted(() => {
    const stored = localStorage.getItem("theme");
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    apply(stored ? stored === "dark" : prefersDark);
  });

  return {
    isDark,
    toggle: () => apply(!isDark.value),
    setDark: (v: boolean) => apply(v),
  };
}
