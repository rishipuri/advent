use std::fs::File;
use std::io::BufReader;
use std::io::prelude::*;

fn main() -> std::io::Result<()> {
    let file = File::open("input.txt")?;
    let reader = BufReader::new(file);

    let mut total = 0;
    let mut total_two = 0;

    for line in reader.lines() {
        let s = line.unwrap();
        let vec: Vec<&str> = s.split(' ').collect();

        match vec[0] {
            "A" => {
                match vec[1] {
                    "X" => {
                        total += 1 + 3;
                        total_two += 3 + 0;
                    },
                    "Y" => {
                        total += 2 + 6;
                        total_two += 1 + 3;
                    },
                    "Z" => {
                        total += 3 + 0;
                        total_two += 2 + 6;
                    },
                    _ => ()
                }
            },
            "B" => {
                match vec[1] {
                    "X" => {
                        total += 1 + 0;
                        total_two += 1 + 0;
                    },
                    "Y" => {
                        total += 2 + 3;
                        total_two += 2 + 3;
                    },
                    "Z" => {
                        total += 3 + 6;
                        total_two += 3 + 6;
                    },
                    _ => ()
                }
            },
            "C" => {
                match vec[1] {
                    "X" => {
                        total += 1 + 6;
                        total_two += 2 + 0;
                    },
                    "Y" => {
                        total += 2 + 0;
                        total_two += 3 + 3;
                    },
                    "Z" => {
                        total += 3 + 3;
                        total_two += 1 + 6;
                    },
                    _ => ()
                }
            },
            _ => (),
        }
    }

    println!("Part 1: {}", total);
    println!("Part 2: {}", total_two);

    Ok(())
}
