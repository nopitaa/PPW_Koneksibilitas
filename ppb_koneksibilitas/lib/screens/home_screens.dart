// file: lib/screens/home_screens.dart
import 'package:flutter/material.dart';
import 'search_screens.dart';
import 'job_detail_page.dart';
import '../widgets/app_bottom_nav.dart';

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
      // bottomNavigationBar: AppBottomNav(
      //   currentIndex: _currentTab,
      //   onTabChanged: (i) => setState(() => _currentTab = i),
      // ),
      bottomNavigationBar: const AppBottomNav(currentIndex: 0),
      body: SafeArea(
        child: Column(
          children: [
            // ===== Header (tetap) =====
            Padding(
              padding: const EdgeInsets.fromLTRB(24, 16, 24, 12),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
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
                ],
              ),
            ),

            // ===== Konten scrollable =====
            Expanded(
              child: SingleChildScrollView(
                padding: const EdgeInsets.symmetric(horizontal: 24),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    // --- Rekomendasi (3 item) ---
                    const Text(
                      'Rekomendasi untuk kamu',
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.w700,
                        color: textDark,
                      ),
                    ),
                    const SizedBox(height: 12),

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
                      logoUrl: 'https://img.icons8.com/fluency/48/pen.png',
                      title: 'Copy Writing',
                      company: 'Code Tulis',
                      tag: 'Remote',
                      tagColor: Colors.amber.shade600,
                    ),

                    const SizedBox(height: 16),

                    // --- Pelatihan Online ---
                    const Text(
                      'Pelatihan Online',
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.w700,
                        color: textDark,
                      ),
                    ),
                    const SizedBox(height: 12),
                    SizedBox(
                      height: 280, 
                      child: ListView(
                        scrollDirection: Axis.horizontal,
                        children: const [
                          TrainingCard(
                            imageUrl: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800',
                            title: 'Belajar dasar-dasar SEO',
                            description: 'Kelas ini membahas konsep dasar Search Engine Optimization (SEO)',
                          ),
                          SizedBox(width: 12),
                          TrainingCard(
                            imageUrl: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800',
                            title: 'UI/UX untuk Pemula',
                            description: 'Pelajari prinsip desain antarmuka & pengalaman pengguna',
                          ),
                          SizedBox(width: 12),
                          TrainingCard(
                            imageUrl: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                            title: 'Kelas Dasar Data Analyst',
                            description: 'Mulai dari statistik dasar hingga visualisasi data, semua dibahas di sini',
                          ),
                        ],
                      ),
                    ),

                    const SizedBox(height: 20),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

// -------------------- Job Card (tanpa ikon save) --------------------
class JobCard extends StatelessWidget {
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
  Widget build(BuildContext context) {
    const primary = Color(0xFF2563EB);
    return Container(
      margin: const EdgeInsets.only(bottom: 14),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        border: Border.all(color: const Color(0xFFE5E7EB)),
        borderRadius: BorderRadius.circular(16),
        boxShadow: const [
          BoxShadow(color: Color(0x0F000000), blurRadius: 10, offset: Offset(0, 4))
        ],
      ),
      child: Row(
        children: [
          CircleAvatar(radius: 22, backgroundImage: NetworkImage(logoUrl)),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
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
                      company,
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
                        color: (tagColor ?? Colors.amber.shade700),
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(width: 6),
                    Text(
                      tag,
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
          SizedBox(
            height: 44,
            child: ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => JobDetailPage(
                      title: title,
                      company: company,
                      logo: logoUrl,
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

// -------------------- Training Card (Pelatihan Online) --------------------
class TrainingCard extends StatelessWidget {
  const TrainingCard({
    super.key,
    required this.imageUrl,
    required this.title,
    required this.description,
  });

  final String imageUrl;
  final String title;
  final String description;

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 220,
      child: Card(
        elevation: 2,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        clipBehavior: Clip.antiAlias,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // gambar
            SizedBox(
              height: 110,
              width: double.infinity,
              child: Image.network(imageUrl, fit: BoxFit.cover),
            ),
            // konten
            Padding(
              padding: const EdgeInsets.all(12),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis,
                    style: const TextStyle(fontWeight: FontWeight.w700),
                  ),
                  const SizedBox(height: 6),
                  Text(
                    description,
                    maxLines: 3,
                    overflow: TextOverflow.ellipsis,
                    style: const TextStyle(color: Color(0xFF6B7280)),
                  ),
                  const SizedBox(height: 10),
                  SizedBox(
                    width: double.infinity,
                    child: ElevatedButton(
                      onPressed: () {},
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xFF2563EB),
                        foregroundColor: Colors.white,
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                      ),
                      child: const Text('Ikuti Pelatihan'),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
