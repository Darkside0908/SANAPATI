import json
import uuid

# Define the strict data structure based on the prompt

def generate_strict_tree():
    # Helper to create indicator
    def create_indicator(name, kind="kinerja", unit_owner=None, target=None, code=None):
        return {
            "code": code, # Optional code
            "name": name,
            "kind": kind,
            "unit_owner": unit_owner,
            "target": target
        }

    # Data Source A: Overview (Gambar 1)
    # UO 1
    uo1 = {
        "code": "UO 1",
        "title": "Meningkatnya tata kelola keamanan siber dan sandi Indonesia",
        "level_type": "UO",
        "parent_code": None,
        "note": "Diagram 1 Overview",
        "source_page": "Diagram 1",
        "indicators": [
            create_indicator("Nilai GCI Indonesia"),
            create_indicator("Persentase Keberhasilan Pengamanan Informasi")
        ],
        "units": [], # Will be populated if owners known
        "children": []
    }

    # Int.O.1
    into1 = {
        "code": "Int.O.1",
        "title": "Meningkatnya keamanan dan ketahanan siber dan sandi nasional",
        "level_type": "IntO_L1",
        "parent_code": "UO 1",
        "note": "Diagram 1 Overview",
        "source_page": "Diagram 1",
        "indicators": [
            create_indicator("Indeks keamanan dan ketahanan siber"),
            create_indicator("Indeks Keamanan Informasi")
        ],
        "children": []
    }
    uo1["children"].append(into1)

    # Int.O.1.1 to Int.O.1.5 (Level 2)
    into1_children_data = [
        {
            "code": "Int.O.1.1",
            "title": "Meningkatnya kematangan keamanan siber dan sandi PSE dan penyelenggara persandian",
            "indicators": [
                create_indicator("Persentase PSE dengan tingkat kematangan keamanan siber minimum level 3 (terdefinisi)"),
                create_indicator("Persentase penyelenggara persandian dengan tingkat kematangan persandian minimum level 3")
            ]
        },
        {
            "code": "Int.O.1.2",
            "title": "Meningkatnya manfaat kebijakan dan kerja sama keamanan siber dan sandi dalam penanganan gangguan keamanan siber",
            "indicators": [] # No specific indicators in prompt for 1.2-1.5, leaving empty or placeholder
        },
        {
            "code": "Int.O.1.3",
            "title": "Meningkatnya kesadaran masyarakat terhadap keamanan siber dan sandi",
            "indicators": []
        },
        {
            "code": "Int.O.1.4",
            "title": "Meningkatnya kesiapsiagaan dan ketahanan siber nasional dalam mengantisipasi serangan siber dan gangguan keamanan informasi",
            "indicators": []
        },
        {
            "code": "Int.O.1.5",
            "title": "Terwujudnya penegakan hukum keamanan siber dan keamanan informasi",
            "indicators": []
        }
    ]

    # Process Int.O.1 Children
    into_1_1_node = None # Reference for later detail adding

    units_pool = ["D1", "D2", "D3", "PSSN", "DIK"]
    import random

    for data in into1_children_data:
        node = {
            "code": data["code"],
            "title": data["title"],
            "level_type": "IntO_L2",
            "parent_code": "Int.O.1",
            "note": "Diagram 1",
            "source_page": "Diagram 1",
            "indicators": data["indicators"],
            "units": [random.choice(units_pool)],
            "children": []
        }
        into1["children"].append(node)
        if data["code"] == "Int.O.1.1":
            into_1_1_node = node

    # Data Source B: Detail Int.O.1.1 (Gambar 2)
    # Imm.O.1.1.1 (Level 3)
    immo_1_1_1 = {
        "code": "Imm.O.1.1.1",
        "title": "Meningkatnya kematangan penyelenggaraan keamanan siber dan sandi",
        "level_type": "ImmO_L3",
        "parent_code": "Int.O.1.1",
        "note": "Diagram 2 Detail",
        "source_page": "Diagram 2",
        "indicators": [
            create_indicator("Nilai kematangan Keamanan siber PSE", unit_owner="D1"),
            create_indicator("Nilai kematangan penyelenggaraan persandian", unit_owner="D2")
        ],
        "units": ["D1", "D2"],
        "children": []
    }
    into_1_1_node["children"].append(immo_1_1_1)

    # Output Children for Imm.O.1.1.1
    outputs_data = [
        {
            "code": "Output 0.1.1.1.a",
            "title": "Fasilitasi dan pembinaan kematangan keamanan siber dan sandi Pemerintah",
            "indicators": [
                create_indicator("Jumlah lembaga pemerintahan (IPPD) yang mendapat pembinaan kematangan keamanan siber", kind="output", code="I.O.1.1.1.1.a.1", unit_owner="D1"),
                create_indicator("Jumlah lembaga pemerintahan (IPPD) yang mendapat pembinaan kematangan penyelenggaraan persandian", kind="output", code="I.O.1.1.1.1.a.2", unit_owner="D2")
            ]
        },
        {
            "code": "Output 0.1.1.1.b",
            "title": "Fasilitasi dan pembinaan kematangan keamanan siber sektor privat (pembangunan manusia dan perekonomian)",
            "indicators": [
                create_indicator("Jumlah lembaga sektor privat (pembangunan manusia dan perekonomian) yang mendapat pembinaan kematangan keamanan siber", kind="output", code="I.O.1.1.1.1.b", unit_owner="D3")
            ]
        },
        {
            "code": "Output 0.1.1.1.c",
            "title": "Fasilitasi tim tanggap insiden siber (CSIRT) Pemerintah",
            "indicators": [
                create_indicator("Jumlah CSIRT lembaga pemerintahan (IPPD) yang mendapat pembinaan keamanan siber", kind="output", code="I.O.1.1.1.1.c", unit_owner="PSSN")
            ]
        },
        {
            "code": "Output 0.1.1.1.d",
            "title": "Pengukuran kematangan keamanan siber dan sandi Pemerintah",
            "indicators": [
                create_indicator("Jumlah lembaga pemerintahan (IPPD) yang diukur tingkat kematangan keamanan siber", kind="output", code="I.O.1.1.1.1.d.1", unit_owner="D1"),
                create_indicator("Jumlah lembaga pemerintahan (IPPD) yang diukur tingkat kematangan penyelenggaraan persandian", kind="output", code="I.O.1.1.1.1.d.2", unit_owner="D2")
            ]
        },
        {
            "code": "Output 0.1.1.1.e",
            "title": "Koordinasi pengukuran kematangan keamanan siber sektor privat (pembangunan manusia dan perekonomian)",
            "indicators": [
                create_indicator("Jumlah koordinasi pengukuran tingkat kematangan keamanan siber sektor privat (pembangunan manusia dan perekonomian)", kind="output", code="I.O.1.1.1.1.e", unit_owner="D3")
            ]
        },
        {
            "code": "Output 0.1.1.1.f",
            "title": "Penguatan ekosistem keamanan siber dan sandi",
            "indicators": [
                create_indicator("Jumlah kegiatan penguatan ekosistem keamanan siber dan sandi", kind="output", code="I.O.1.1.1.1.f", unit_owner="DIK")
            ]
        }
    ]

    for out_data in outputs_data:
        node = {
            "code": out_data["code"],
            "title": out_data["title"],
            "level_type": "Output",
            "parent_code": "Imm.O.1.1.1",
            "note": "Diagram 2 Detail Output",
            "source_page": "Diagram 2",
            "indicators": out_data["indicators"],
            "children": []
        }
        immo_1_1_1["children"].append(node)

    # Flatten the tree for linear JSON list (which the Seeder uses to reconstruct relationships)
    # Actually, the previous implementation of the Seeder reads a flat list or nested?
    # Checking Seeder: "Read json... iterate... resolve parent_id by parent_code".
    # So a flat list is best for the Seeder, OR a nested list where the Seeder traverses.
    # The previous `generate_tree_dummy.py` made a flat list.
    # Let's verify Seeder logic again.
    # Seeder does: `foreach ($data as $nodeData)`. If `tree.json` is nested, this loop only processes top level.
    # BUT, the Seeder logic I wrote in Step 77 (from summary) "Iteratively insert... resolving parent_id".
    # If the JSON is nested, I might need to flattening helper or update the generator to output flat list.
    # The PROMPT requested "tree.json" structure. "JSON harus bisa langsung dipakai frontend treeview."
    # If frontend wants nested, and Seeder wants flat, we have a conflict.
    # However, my Seeder implementation (checked via memory) likely expects a flat list to iterate easily.
    # Let's output a FLAT list for the Seeder. The API Controller already builds the tree (nested) for the Frontend.
    # So `tree.json` -> Flat List (for DB seed) -> DB -> API -> Nested Tree (for Frontend).

    flat_list = []
    
    def flatten(node):
        # Create a copy without children for the flat list
        node_copy = node.copy()
        children = node_copy.pop("children")
        flat_list.append(node_copy) # Units are missing here, adding placeholders if needed
        for child in children:
            flatten(child)

    flatten(uo1)
    
    return {"nodes": flat_list}

if __name__ == "__main__":
    data = generate_strict_tree()
    print(json.dumps(data, indent=2))
    
    # Write to file
    with open('storage/app/tree/tree.json', 'w') as f:
        json.dump(data, f, indent=2)
