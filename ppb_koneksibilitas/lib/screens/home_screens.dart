// file: lib/screens/home_screens.dart
import 'package:flutter/material.dart';
import 'search_screens.dart';
import 'job_detail_page.dart';

class HomeScreens extends StatefulWidget {
  const HomeScreens({super.key});

  @override
  State<HomeScreens> createState() => _HomeScreensState();
}

class _HomeScreensState extends State<HomeScreens> {
  final TextEditingController _searchC = TextEditingController();

  int _currentTab = 0;
  int _selectedFilterIndex = 0;

  final List<String> _filters = ['Semua', 'Full-time', 'Entry level', 'Remote'];

  @override
  void dispose() {
    _searchC.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    const primary = Color(0xFF2563EB);
    const textDark = Color(0xFF1F2937);

    return Scaffold(
      backgroundColor: Colors.white,
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _currentTab,
        onTap: (i) {
          if (i == 1) {
            // buka halaman "Simpan"
            Navigator.pushNamed(context, '/saved-jobs');
            return;
          }
          setState(() => _currentTab = i);
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
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.fromLTRB(24, 16, 24, 24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Greeting
              Text.rich(
                TextSpan(
                  children: [
                    const TextSpan(
                      text: 'Halo! Ruby Selamat Datang',
                      style: TextStyle(
                        color: textDark,
                        fontSize: 20,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                    TextSpan(
                      text: ' 👋🏻',
                      style: TextStyle(
                        fontSize: 20,
                        color: Colors.orange.shade400,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),

              // Headline
              RichText(
                text: const TextSpan(
                  style: TextStyle(
                    fontSize: 34,
                    height: 1.2,
                    fontWeight: FontWeight.w700,
                    color: textDark,
                  ),
                  children: [
                    TextSpan(text: 'Gunakan Kesempatanmu\n'),
                    TextSpan(
                      text: 'Di Koneksibilitas',
                      style: TextStyle(color: primary),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),

              // Search Field
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => const SearchScreens()),
                  );
                },
                child: Container(
                  height: 52,
                  decoration: BoxDecoration(
                    color: const Color(0xFFF3F4F6),
                    borderRadius: BorderRadius.circular(16),
                  ),
                  padding: const EdgeInsets.symmetric(horizontal: 12),
                  child: const Row(
                    children: [
                      Icon(Icons.search, size: 24, color: Colors.black54),
                      SizedBox(width: 8),
                      Text(
                        'Cari pekerjaan…',
                        style: TextStyle(
                          color: Color(0xFF9CA3AF),
                          fontSize: 16,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              const SizedBox(height: 16),

              // Filter chips
              SingleChildScrollView(
                scrollDirection: Axis.horizontal,
                child: Row(
                  children: List.generate(_filters.length, (index) {
                    final selected = _selectedFilterIndex == index;
                    return Padding(
                      padding: EdgeInsets.only(right: index == _filters.length - 1 ? 0 : 12),
                      child: ChoiceChip(
                        label: Text(_filters[index]),
                        selected: selected,
                        onSelected: (_) => setState(() => _selectedFilterIndex = index),
                        selectedColor: textDark,
                        backgroundColor: const Color(0xFFF3F4F6),
                        labelStyle: TextStyle(
                          color: selected ? Colors.white : const Color(0xFF374151),
                          fontWeight: FontWeight.w600,
                        ),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(24),
                        ),
                      ),
                    );
                  }),
                ),
              ),
              const SizedBox(height: 20),

              const Text(
                'Rekomendasi untuk kamu',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.w700,
                  color: textDark,
                ),
              ),
              const SizedBox(height: 12),

              // Job cards
              JobCard(
                logoUrl: 'https://img.icons8.com/color/48/000000/facebook-new.png',
                title: 'Admin Sosial Media',
                company: 'GlobalTrans Indo',
                tag: 'Full-time',
                tagColor: Colors.amber.shade600,
              ),
              JobCard(
                logoUrl: 'https://img.icons8.com/color/48/000000/adobe-illustrator.png',
                title: 'Desain Grafis',
                company: 'Studi Flue',
                tag: 'Entry Level',
                tagColor: Colors.amber.shade600,
              ),
              JobCard(
                logoUrl: 'https://via.placeholder.com/56?text=CW',
                title: 'Copy Writing',
                company: 'Code Tulis',
                tag: 'Remote',
                tagColor: Colors.amber.shade600,
              ),
              JobCard(
                logoUrl: 'https://img.icons8.com/color/48/000000/database.png',
                title: 'Data Entry Operator',
                company: 'PT. Agrpadana',
                tag: 'Entry Level',
                tagColor: Colors.amber.shade600,
              ),
              JobCard(
                logoUrl: 'https://via.placeholder.com/56?text=AX',
                title: 'Animator 2D/3D',
                company: 'Animax Studio',
                tag: 'Full-time',
                tagColor: Colors.amber.shade600,
              ),
            ],
          ),
        ),
      ),
    );
  }
}

// -------------------- Job Card (with save & detail) --------------------

class JobCard extends StatefulWidget {
  const JobCard({
    super.key,
    required this.logoUrl,
    required this.title,
    required this.company,
    required this.tag,
    this.tagColor,
  });

  final String logoUrl;
  final String title;
  final String company;
  final String tag;
  final Color? tagColor;

  @override
  State<JobCard> createState() => _JobCardState();
}

class _JobCardState extends State<JobCard> {
  bool _saved = false;

  @override
  Widget build(BuildContext context) {
    const primary = Color(0xFF2563EB);
    return Container(
      margin: const EdgeInsets.only(bottom: 14),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        border: Border.all(color: const Color(0xFFE5E7EB)),
        borderRadius: BorderRadius.circular(16),
        boxShadow: const [BoxShadow(color: Color(0x0F000000), blurRadius: 10, offset: Offset(0, 4))],
      ),
      child: Row(
        children: [
          CircleAvatar(radius: 22, backgroundImage: NetworkImage(widget.logoUrl)),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  widget.title,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.w700,
                    color: Color(0xFF111827),
                  ),
                ),
                const SizedBox(height: 6),
                Row(
                  children: [
                    Text(
                      widget.company,
                      style: const TextStyle(
                        fontSize: 14,
                        color: Color(0xFF6B7280),
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                    const SizedBox(width: 8),
                    Text(
                      '•',
                      style: TextStyle(
                        color: (widget.tagColor ?? Colors.amber.shade700),
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(width: 6),
                    Text(
                      widget.tag,
                      style: const TextStyle(
                        fontSize: 14,
                        color: Color(0xFF4B5563),
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
          // --- ikon Save ---
          IconButton(
            tooltip: _saved ? 'Hapus dari Simpan' : 'Simpan lowongan',
            icon: Icon(_saved ? Icons.bookmark : Icons.bookmark_border),
            color: _saved ? primary : const Color(0xFF6B7280),
            onPressed: () {
              setState(() => _saved = !_saved);
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                  content: Text(_saved
                      ? 'Lowongan disimpan'
                      : 'Lowongan dihapus dari simpan'),
                  duration: const Duration(seconds: 1),
                ),
              );
            },
          ),
          // --- tombol Info ---
          SizedBox(
            height: 44,
            child: ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => JobDetailPage(
                      title: widget.title,
                      company: widget.company,
                      logo: widget.logoUrl,
                    ),
                  ),
                );
              },
              style: ElevatedButton.styleFrom(
                backgroundColor: primary,
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
                padding: const EdgeInsets.symmetric(horizontal: 18),
              ),
              child: const Text('Info', style: TextStyle(fontSize: 16, fontWeight: FontWeight.w700)),
            ),
          ),
        ],
      ),
    );
  }
}
