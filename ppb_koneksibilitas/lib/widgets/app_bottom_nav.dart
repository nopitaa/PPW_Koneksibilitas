import 'package:flutter/material.dart';

class AppBottomNav extends StatelessWidget {
  const AppBottomNav({
    super.key,
    required this.currentIndex,
    this.onTabChanged,
  });

  final int currentIndex;
  final ValueChanged<int>? onTabChanged;

  @override
  Widget build(BuildContext context) {
    const primary = Color(0xFF2563EB);

    return BottomNavigationBar(
      currentIndex: currentIndex,
      onTap: (i) {
        if (i == 1) {
          if (ModalRoute.of(context)?.settings.name != '/saved-jobs') {
            Navigator.pushNamed(context, '/saved-jobs');
          }
          return;
        }
        onTabChanged?.call(i);
      },
      type: BottomNavigationBarType.fixed,
      selectedItemColor: primary,
      unselectedItemColor: const Color(0xFF9CA3AF),
      showUnselectedLabels: true,
      items: const [
        BottomNavigationBarItem(icon: Icon(Icons.home_rounded), label: 'Home'),
        BottomNavigationBarItem(icon: Icon(Icons.bookmark_border), label: 'Simpan'),
        BottomNavigationBarItem(icon: Icon(Icons.donut_large_outlined), label: 'Status'),
        BottomNavigationBarItem(icon: Icon(Icons.person_outline), label: 'Akun'),
      ],
    );
  }
}
