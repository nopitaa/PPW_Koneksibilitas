import 'package:flutter/material.dart';
import 'screens/home_screens.dart';
import 'screens/saved_jobs_page.dart';
import 'screens/login_screens.dart';
import 'screens/register_screens.dart';
import 'screens/status_lamaran.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Koneksibilitas',
      theme: ThemeData(
        primarySwatch: Colors.indigo,
        scaffoldBackgroundColor: Colors.white,
        fontFamily: 'Inter',
      ),

      // Halaman pertama kali dijalankan
      home: const LoginScreen(),

      // Daftar route
      routes: {
        '/home': (context) => const HomeScreens(),
        '/saved-jobs': (context) => const SavedJobsPage(),
        '/register': (context) => const RegisterScreen(),
        '/status-lamaran': (context) => const StatusLamaranPage(),
      },
    );
  }
}
