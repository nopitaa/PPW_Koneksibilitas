// ignore_for_file: use_build_context_synchronously

import 'package:flutter/material.dart';
import 'register_screens.dart'; // Import file register
import 'home_screens.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  bool isChecked = false; // status checkbox
  bool _obscureText = true; // nilai awal: password tersembunyi

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const SizedBox(height: 80),
              Image.asset('assets/login.png', height: 150),
              const SizedBox(height: 20),

              const Text(
                'KONEKSIBILITAS',
                style: TextStyle(
                  color: Colors.blue,
                  fontWeight: FontWeight.bold,
                  fontSize: 20,
                ),
              ),
              const Text('Masuk sebagai pekerja'),
              const SizedBox(height: 30),

              // Bagian Email
              TextField(
                controller: emailController,
                decoration: InputDecoration(
                  hintText: 'Email',
                  prefixIcon: const Icon(Icons.email_outlined),
                  filled: true,
                  fillColor:
                      Colors.grey.shade100, // warna abu muda di background
                  contentPadding: const EdgeInsets.symmetric(
                    vertical: 18,
                    horizontal: 15,
                  ),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(15),
                    borderSide: BorderSide.none, // tanpa garis tepi
                  ),
                ),
              ),
              const SizedBox(height: 15),

              // Bagian Password
              TextField(
                controller: passwordController,
                obscureText: _obscureText,
                decoration: InputDecoration(
                  hintText: 'Password',
                  prefixIcon: const Icon(Icons.lock_outline),
                  suffixIcon: IconButton(
                    icon: Icon(
                      _obscureText
                          ? Icons.visibility_off_outlined
                          : Icons.visibility_outlined,
                    ),
                    onPressed: () {
                      setState(() {
                        _obscureText = !_obscureText; // ubah visibility
                      });
                    },
                  ),
                  filled: true,
                  fillColor: Colors.grey.shade100,
                  contentPadding: const EdgeInsets.symmetric(
                    vertical: 18,
                    horizontal: 15,
                  ),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(15),
                    borderSide: BorderSide.none,
                  ),
                ),
              ),
              const SizedBox(height: 10),

              //Bagian Teks "Lupa password?"
              Align(
                alignment: Alignment.centerRight,
                child: TextButton(
                  onPressed: () {},
                  style: TextButton.styleFrom(padding: EdgeInsets.zero),
                  child: const Text(
                    'Lupa password?',
                    style: TextStyle(color: Colors.blue, fontSize: 10),
                  ),
                ),
              ),

              // Bagian Checkbox
              Row(
                children: [
                  Transform.scale(
                    scale: 1.2,
                    child: Checkbox(
                      shape: const CircleBorder(), // biar checkbox nya bulat
                      value: isChecked,
                      activeColor: Colors.green,
                      onChanged: (value) {
                        setState(() {
                          isChecked = value ?? false; //disini null safety
                        });
                      },
                    ),
                  ),
                  const SizedBox(width: 6),
                  const Expanded(
                    child: Text(
                      'Dengan lanjut, anda setuju pada ketentuan, privasi, dan cookie koneksibilitas',
                      style: TextStyle(fontSize: 12),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 20),

              // Bagian Tombol Sign In
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.blue,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30),
                    ),
                    padding: const EdgeInsets.symmetric(vertical: 15),
                  ),
                  onPressed: () {
                    if (isChecked) {
                      // Tampilkan SnackBar warna hijau
                      ScaffoldMessenger.of(context).showSnackBar(
                        SnackBar(
                          backgroundColor: Colors.green,
                          content: const Text(
                            'Login berhasil',
                            style: TextStyle(color: Colors.white),
                          ),
                        ),
                      );
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(builder: (context) => HomeScreens()),
                      );
                    } else {
                      // Jika belum centang persetujuan
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text(
                            'Harap centang persetujuan terlebih dahulu',
                          ),
                        ),
                      );
                    }
                  },
                  child: const Text(
                    'Sign In',
                    style: TextStyle(color: Colors.white),
                  ),
                ),
              ),
              const SizedBox(height: 10),

              // Bagian Tombol Sign Up
              SizedBox(
                width: double.infinity,
                child: OutlinedButton(
                  style: OutlinedButton.styleFrom(
                    side: const BorderSide(color: Colors.blue),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30),
                    ),
                    padding: const EdgeInsets.symmetric(vertical: 15),
                  ),
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => RegisterScreen()),
                    );
                  },
                  child: const Text(
                    'Sign Up',
                    style: TextStyle(color: Colors.blue),
                  ),
                ),
              ),
              const SizedBox(height: 20),
              RichText(
                text: const TextSpan(
                  style: TextStyle(fontSize: 12, fontFamily: 'Inter'),
                  children: [
                    TextSpan(
                      text: 'Kamu ingin masuk sebagai ',
                      style: TextStyle(color: Colors.black),
                    ),
                    TextSpan(
                      text: 'Penyedia Kerja?',
                      style: TextStyle(color: Colors.blue),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
