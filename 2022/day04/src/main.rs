use std::fs::File;
use std::io::{BufReader, Result};
use std::io::prelude::*;

fn in_range_any(range: &Vec<u32>, start: u32, end: u32) -> bool {
    (range[0] <= start && range[1] >= start) || (range[0] <= end && range[1] >= end)
}

fn in_range_completely(range: &Vec<u32>, start: u32, end: u32) -> bool {
    range[0] <= start && range[1] >= end
}

fn solve(pairs: Vec<String>) {
    let mut part_one = 0;
    let mut part_two = 0;

    for line in pairs {
        let assignments: Vec<&str> = line.split(",").collect();

        let first: Vec<u32> = assignments[0]
            .split("-")
            .map(|v| v.parse().unwrap())
            .collect();

        let second: Vec<u32> = assignments[1]
            .split("-")
            .map(|v| v.parse().unwrap())
            .collect();

        if in_range_completely(&first, second[0], second[1]) || in_range_completely(&second, first[0], first[1]) {
            part_one += 1;
        }

        if in_range_any(&first, second[0], second[1]) || in_range_any(&second, first[0], first[1]) {
            part_two += 1;
        }
    }

    println!("Part 1: {}", part_one);
    println!("Part 2: {}", part_two);
}

fn main() -> Result<()> {
    let file = File::open("input.txt")?;
    let reader = BufReader::new(file);

    let pairs: Vec<String> = reader
        .lines()
        .map(|l| l.unwrap())
        .collect();

    solve(pairs);

    Ok(())
}
