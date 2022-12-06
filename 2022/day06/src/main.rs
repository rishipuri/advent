use std::collections::HashMap;

fn main() {
    let input = include_str!("../input.txt");

    let mut chars: HashMap<char, i32> = HashMap::new();
    let mut index = 0;
    let mut cutoff = 0;
    let mut unique = 0;
    let mut part_one = -1;
    let mut part_two = -1;

    for ch in input.chars() {
        match chars.get(&ch) {
            Some(count) => {
                if cutoff > *count {
                    unique += 1;
                } else {
                    unique = index - count;
                    cutoff = *count + 1;
                }
            },
            None => {
                unique += 1;
            }
        }

        chars.insert(ch, index);
        index += 1;

        if part_one == -1 && unique == 4 {
            part_one = index;
        }

        if unique == 14 {
            part_two = index;
            break;
        }
    }

    println!("Part 1: {}", part_one);
    println!("Part 2: {}", part_two);
}
