import 'package:flutter/material.dart';
import 'saved_jobs_page.dart';

void main() {
  runApp(const JobApp());
}

class JobApp extends StatelessWidget {
  const JobApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Lowongan Tersimpan',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
        scaffoldBackgroundColor: Colors.white,
        fontFamily: 'Inter',
      ),
      home: const SavedJobsPage(),
    );
  }
}