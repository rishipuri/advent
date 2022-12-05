fn part_one(crates: &str, instructions: &str) -> String {
    let mut crates = parse_crates(crates);
    let instructions = parse_instructions(instructions);

    for instruct in instructions {
        if instruct.len() == 0 {
            continue;
        }

        for _i in 0..instruct[0] {
            let val = &crates[(instruct[1] - 1) as usize].pop().unwrap();
            crates[(instruct[2] - 1) as usize].push(val.to_owned());
        }
    }

    build_result(&mut crates)
}

fn part_two(crates: &str, instructions: &str) -> String {
    let mut crates = parse_crates(crates);
    let instructions = parse_instructions(instructions);

    for instruct in instructions {
        if instruct.len() == 0 {
            continue;
        }

        let mut temp = vec![];

        for _i in 0..instruct[0] {
            let val = &crates[(instruct[1] - 1) as usize].pop().unwrap();

            temp.push(val.to_owned());
        }

        temp.reverse();

        for i in temp {
            crates[(instruct[2] - 1) as usize].push(i.to_owned());
        }
    }

    build_result(&mut crates)
}

fn parse_crates(crates: &str) -> Vec<Vec<String>> {
    let mut crates_vec: Vec<Vec<String>> = vec![vec![]; 9];

    let crates_lines: Vec<_> = crates.split("\n").collect();

    for i in 0..crates_lines.len() - 1 {
        for j in 0..9 {
            let ch = crates_lines[i].chars().nth(4*j+1).unwrap();
            if ch.is_uppercase() {
                crates_vec[j].push(ch.to_string());
            }
        }
    }

    for val in &mut crates_vec {
        val.reverse();
    }

    crates_vec
}

fn parse_instructions(instructions: &str) -> Vec<Vec<u8>> {
    let instructions: Vec<_> = instructions.split("\n").collect();
    let mut result: Vec<Vec<u8>> = vec![vec![]];

    for line in instructions {
        let mut temp = vec![];

        let parts = line
            .split_whitespace()
            .map(|s| s.parse::<u8>())
            .collect::<Vec<_>>();

        for p in parts {
            match p {
                Ok(n) => temp.push(n),
                _ => (),
            };
        }

        result.push(temp);
    }

    result
}

fn build_result(crates: &mut Vec<Vec<String>>) -> String {
    let mut result = String::from("");

    for x in 0..9 {
        if crates[x].len() > 0 {
            let val = crates[x].pop().unwrap();

            result.push_str(&val);
        }
    }

    result
}

fn main() -> std::io::Result<()> {
    let input = include_str!("../input.txt");

    let (crates, instructions) = input.split_once("\n\n").unwrap();

    println!("Part 1: {}", part_one(crates, instructions));
    println!("Part 2: {}", part_two(crates, instructions));

    Ok(())
}
